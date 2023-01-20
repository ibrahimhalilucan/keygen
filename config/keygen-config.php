<?php

/**
 * This file is config of the Keygen package. You would also expect to see a generator
 * config file containing all the configuration parameters your application needed to execute.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * (c) İbrahim Halil Uçan <ibrahimhalilucan@gmail.com>
 */

return [
    /*
   |--------------------------------------------------------------------------
   | Char Length
   |--------------------------------------------------------------------------
   | The number of characters in the data. This value is typically used to specify the maximum length of a string.
   |
   */
    'char_length'      => 8,

    /*
   |--------------------------------------------------------------------------
   | Integer Mın
   |--------------------------------------------------------------------------
   | The minimum value for an integer. This value is typically used to specify the minimum value that an integer data type can take.
   |
   */
    'integer_min'      => 0,

    /*
   |--------------------------------------------------------------------------
   | Integer MAX
   |--------------------------------------------------------------------------
   | The maximum value for an integer. This value is typically used to specify the maximum value that an integer data type can take.
   |
   */
    'integer_max'      => 100000,

    /*
    |--------------------------------------------------------------------------
    | Serial Length
    |--------------------------------------------------------------------------
    | The length of the serial number. This value is typically used to specify the length of a serial number or other identifier.
    |
    */
    'serial_length'    => 6,

    /*
    |--------------------------------------------------------------------------
    | Serial Parts
    |--------------------------------------------------------------------------
    | The number of parts in the serial number. This value is typically used to specify the number of segments or
    | sections that make up a serial number or other identifier.
    |
    */
    'serial_parts'     => 4,

    /*
    |--------------------------------------------------------------------------
    | Serial Separator
    |--------------------------------------------------------------------------
    | The separator used in the serial number. This value is typically used to specify the character or string used to
    | separate the parts of a serial number or other identifier.
    |
    */
    'serial_separator' => "-",

    /*
    |--------------------------------------------------------------------------
    | Token Length
    |--------------------------------------------------------------------------
    | The length of the token. This value is typically used to specify the length of an authentication or security token.
    |
    */
    'token_length'     => 64,

    /*
    |--------------------------------------------------------------------------
    | Float Min
    |--------------------------------------------------------------------------
    | The minimum value for a float. This value is typically used to specify the minimum value that a float data type can take.
    |
    */
    'float_min'     => 0.0,

    /*
    |--------------------------------------------------------------------------
    | Float Max
    |--------------------------------------------------------------------------
    | The maximum value for a float. This value is typically used to specify the maximum value that a float data type can take.
    |
    */
    'float_max'     => 100.0,
    /*
    |--------------------------------------------------------------------------
    | Float Decimal
    |--------------------------------------------------------------------------
    | The number of decimal places for a float. This value is typically used to specify the number of decimal places for a float data type.
    |
    */
    'float_decimal' => 2,
];
