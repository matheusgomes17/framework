<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Data Serializer
    |--------------------------------------------------------------------------
    |
    | Here you may choose the default data serializer to be used as the API
    | output format, serializers let you switch between various output formats
    | with minimal effect on your transformers.
    |
    | Supported: DataArraySerializer, ArraySerializer and JsonApiSerializer
    |
    | You can also create your own serializer, see more at the link below:
    | http://fractal.thephpleague.com/serializers
    |
    */
    'serializer' => League\Fractal\Serializer\DataArraySerializer::class,
];