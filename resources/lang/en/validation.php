<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],


    'name'=> 
    [
        'required' => 'نام کاربر الزامی می باشد' ,
        'min' => 'نام کاربر می بایست حداقل 3 کاراکتر وارد شود' ,
        'string' => 'نام کاربر می بایست فقط کاراکتر وارد شود' , 
    ],
    'email' => 
    [
        'required' =>  'ایمیل الزامی می باشد' ,
        'unique' => 'ایمیل تکراری می باشد' ,
        'min' => 'ایمیل می بایست حداقل 14 کاراکتر وارد شود' ,
        'email' => 'با فورمت ایمیل وارد نمایید' ,
    ],
    'password' => 
    [
        'min' =>  'کلمه عبور می بایست حداقل 8 کاراکتر وارد شود' ,
        'required' =>  'کلمه عبور الزامی می باشد' ,
        'min' =>  'کلمه عبور می بایست حداقل 8 کاراکتر یا عدد وارد شود' ,
    ],
    'tell' => 
    [
        'required' => 'شماره تلفن الزامی می باشد' ,
        'min' => 'شماره تلفن می بایست حداقل 11 رقم وارد شود' ,
        'numeric' => 'شماره تلفن می بایست فقط عدد وارد شود' ,
        'unique' => 'شماره تلفن تکراری می باشد' ,
    ] ,

    
    'channel_name' => 
    [   
        'required' => 'عنوان شبکه الزامی می باشد' ,
        'unique' => 'عنوان شبکه تکراری می باشد' ,
        'min' =>  'عنوان شبکه می بایست حداقل 3 کاراکتر وارد شود' ,
    ],
    'degree' => 
    [
        'required' => 'مشخصه شبکه الزامی می باشد' ,
        'unique' => 'مشخصه شبکه تکراری می باشد' ,
        'min' =>  'مشخصه شبکه می بایست حداقل 1 رقم وارد شود' ,
        'max' =>  'مشخصه شبکه می بایست حداکثر 3 رقم وارد شود' ,
    ],


    'channel_id' => 
    [
        'required' => 'انتخاب شبکه الزامی می باشد' ,
    ] ,
    'class_name' => 
    [
        'required' => 'عنوان طبقه الزامی می باشد' ,
        'unique' => 'عنوان طبقه تکراری می باشد' ,
        'min' =>  'عنوان طبقه می بایست حداقل 1 کاراکتر وارد شود' ,
    ],


    'box_type' => 
    [ 
        'required' => 'عنوان باکس الزامی می باشد' ,
        'unique' => 'عنوان باکس تکراری می باشد' ,
        'min' =>  'عنوان باکس می بایست حداقل 3 کاراکتر وارد شود' ,
    ], 


    'prog_group' => 
    [
        'required' => 'نوع برنامه الزامی می باشد' ,
        'unique' => 'نوع برنامه تکراری می باشد' ,
        'min' =>  'عنوان برنامه می بایست حداقل 3 کاراکتر وارد شود' ,
        'string' => 'عنوان برنامه می بایست کاراکتر وارد شود' ,
    ],


    'coef' => 
    [
        'required' => 'ضریب آرم آگهی الزامی می باشد' ,
        'min' =>  'ضریب آرم آگهی می بایست حداقل 1 رقم وارد شود' ,
        'max' => 'ضریب آرم آگهی می بایست حداکثر 3 رقم وارد شود' ,
        'numeric' => 'فقط عدد وارد شود' , 
        'gt' => 'عدد وارد شده می بایست از صفر بزرگتر باشد' ,
        'between' =>  'عدد وارد شده می بایست بین 1 تا 200 باشد' ,
    ],

    'from_date' => 
    [
        'required' => 'از تاریخ الزامی می باشد' ,
        'date' => 'از تاریخ انتخاب شود' ,
    ],

    'to_date' => 
    [ 
        'required' => 'تا تاریخ الزامی می باشد' ,
        'date' => 'تا تاریخ انتخاب شود'
    ],

    'adver_type_id' => 
    [
        'required' => 'نوع کدآگهی الزامی می باشد' ,
    ],


    'adver_type' => 
    [
        'required' => 'نوع کدآگهی الزامی می باشد' ,
        'min' => 'نوع کدآگهی می بایست حداقل 3 کاراکتر وارد شود' ,
        'unique' => 'نوع کدآگهی تکراری می باشد' ,
    ],

    
    'title' =>
    [
        'required' =>  'عنوان باکس الزامی می باشد' ,
        'min' => 'عنوان باکس می بایست حداقل 3 کاراکتر وارد شود' ,
        'max' => 'عنوان باکس می بایست حداکثر 30 کاراکتر وارد شود' ,
        'unique' => 'عنوان باکس تکراری می باشد' ,
    ],


    'cast' => 
    [
        'required' => 'عنوان صنف الزامی می باشد' ,  
        'unique' => 'عنوان صنف تکراری می باشد' , 
        'min' => 'عنوان صنف می بایست حداقل 3 کاراکتر وارد شود' , 
    ],



    'owner' => 
    [
        'required' => 'نام صاحب آگهی الزامی می باشد' , 
        'unique' => 'نام صاحب آگهی تکراری می باشد' ,
        'min' => 'نام صاحب آگهی می بایست حداقل 3 کارکتر وارد شود' , 
    ],



    'cast_id' => 
    [
        'required' => 'عنوان صنف الزامی می باشد' , 
    ],


    'product' => 
    [
        'required' => 'عنوان محصول الزامی می باشد' ,
        'min' => 'عنوان محصول می بایست حداقل 3 کاراکتر وارد شود' ,
        'unique' => 'عنوان محصول تکراری می باشد' ,
    ],


    'channel_id' =>  
    [
        'required' => 'عنوان شبکه الزامی می باشد' ,
    ], 

    'classes_id' => 
    [
        'required' => 'عنوان طبقه الزامی می باشد' ,
    ], 

    'box_type_id' => 
    [
        'required' => 'عنوان باکس الزامی می باشد' ,
    ],

    'price' => 
    [
        'required' => 'مبلغ تعرفه الزامی می باشد' ,
        'min' => 'مبلغ تعرفه می بایست حداقل 6 رقم وارد شود'
    ],



], 


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];


