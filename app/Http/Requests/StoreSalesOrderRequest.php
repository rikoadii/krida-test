<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreSalesOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'orderNo' => ['nullable', 'string', 'max:30'],
            'orderDate' => ['required', 'date'],
            'custId' => ['required', 'exists:customers,custId'],
            'discAmount' => ['numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*' => ['required', 'array:itemId,qty,price,discAmount'],
            'items.*.itemId' => ['required', 'exists:items,itemId'],
            'items.*.qty' => ['required', 'numeric', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
            'items.*.discAmount' => ['numeric', 'min:0'],
        ];
    }

    /**
     * @return array<int, callable(Validator): void>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                $subtotal = 0.0;

                foreach ($this->input('items', []) as $index => $item) {
                    $grossItem = (float) $item['qty'] * (float) $item['price'];
                    $itemDiscAmount = (float) ($item['discAmount'] ?? 0);

                    if ($itemDiscAmount > $grossItem) {
                        $validator->errors()->add(
                            "items.{$index}.discAmount",
                            'Diskon item tidak boleh lebih besar dari nilai item.'
                        );
                    }

                    $subtotal += $grossItem - $itemDiscAmount;
                }

                if ((float) $this->input('discAmount', 0) > $subtotal) {
                    $validator->errors()->add(
                        'discAmount',
                        'Diskon order tidak boleh lebih besar dari subtotal.'
                    );
                }
            },
        ];
    }

    protected function prepareForValidation(): void
    {
        $rawItems = is_array($this->input('items')) ? $this->input('items') : [];

        $items = collect($rawItems)
            ->filter(fn (mixed $item): bool => is_array($item) && filled($item['itemId'] ?? null))
            ->map(function (array $item): array {
                $item['discAmount'] = $item['discAmount'] ?? 0;

                return $item;
            })
            ->values()
            ->all();

        $this->merge([
            'discAmount' => $this->input('discAmount') ?? 0,
            'items' => $items,
        ]);
    }
}
