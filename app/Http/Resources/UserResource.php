<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prefixname' => $this->prefixname,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'suffixname' => $this->suffixname,
            'username' => $this->username,
            'email' => $this->email,
            'photo' => $this->photo,
            'type' => $this->type,
            'updated_at' => $this->created_at->format('Y-m-d H:m:s')
        ];
    }
}
