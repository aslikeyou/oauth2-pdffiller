<?php

namespace aslikeyou\OAuth2\Client\Provider;


class FillRequest extends BaseEntity
{
    public function listItems() {
        return $this->client->queryApiCall('fill_request/');
    }

    public function info($id) {
        return $this->client->queryApiCall('fill_request/'.$id);
    }

    public function listFilledForms($id){
        return $this->client->queryApiCall('fill_request/'.$id.'/filled_form');
    }

    public function filledFormInfo($id, $filled_form_id){
        return $this->client->queryApiCall('fill_request/'.$id.'/filled_form/'.$filled_form_id);
    }

    /**
     * @param $request  (FillRequestDto->toArray());
     * @return mixed
     */
    public function createFillRequest($request) {
        return $this->client->postApiCall('fill_request', [
            'json' => $request
        ]);
    }
}