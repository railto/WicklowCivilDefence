<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_by' => (int) $this->created_by,
            'location' => $this->location,
            'start' => $this->start,
            'end' => $this->end,
            'type' => $this->type,
            'officer_in_charge' => $this->officer_in_charge,
            'search_manager' => $this->search_manager,
            'safety_officer' => $this->safety_officer,
            'section_leader' => $this->section_leader,
            'radio_operator' => $this->radio_operator,
            'scribe' => $this->scribe,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
