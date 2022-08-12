<?php

namespace App\DTO;

use App\Http\Requests\BaseFormRequest;

abstract class BaseDTO
{
    abstract protected static function map(): array;

    /**
     * @param BaseFormRequest $request
     * @return static
     */
    public static function fromRequest( BaseFormRequest $request ): static
    {
        $dto = new static();
        foreach ( $request->only( array_keys( static::map() ) ) as $key => $value ) {
            if ( !isset( static::map()[ $key ] ) ) {
                continue;
            }

            $item = static::map()[ $key ];
            settype( $value, $item['type'] );
            $dto_property = $item['property'];

            $dto->$dto_property = $value;
        }

        return $dto;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $output = [];
        foreach ( static::map() as $tmp ) {
            if ( isset( $tmp[ 'property' ] ) ) {
                $property = $tmp[ 'property' ];
                if ( property_exists( $this, $property ) ) {
                    $output[ $property ] = $this->$property;
                }
            }
        }

        return $output;
    }
}
