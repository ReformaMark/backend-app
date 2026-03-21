<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'branch' => [
                'id' => $this->id,
                'name' => $this->name,
                'location' => $this->location,
            ],
            'sales_summary' => [
               'year' => $this->sales()
                    ->whereYear('created_at', now()->year)
                    ->pluck('id'),
                'month' => $this->sales()->whereMonth('created_at', now()->month)->sum('total_amount'),
                'week'  => $this->sales()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_amount'),
            ],
        ];
    }
}
