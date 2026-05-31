<?php

return [

    /*
    |--------------------------------------------------------------------------
    | خطوط پیام‌های اعتبارسنجی
    |--------------------------------------------------------------------------
    |
    | خطوط زیر شامل پیام‌های خطای پیش‌فرض است که توسط کلاس Validator استفاده می‌شوند.
    | برخی از این قواعد نسخه‌های متفاوتی دارند مانند قواعد اندازه. می‌توانید هر پیام را به دلخواه تغییر دهید.
    |
    */

    'accepted' => 'فیلد :attribute باید پذیرفته شود.',
    'accepted_if' => 'فیلد :attribute باید زمانی پذیرفته شود که :other برابر با :value باشد.',
    'active_url' => 'فیلد :attribute باید یک URL معتبر باشد.',
    'after' => 'فیلد :attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal' => 'فیلد :attribute باید تاریخی بعد از یا برابر با :date باشد.',
    'alpha' => 'فیلد :attribute تنها می‌تواند شامل حروف باشد.',
    'alpha_dash' => 'فیلد :attribute تنها می‌تواند شامل حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num' => 'فیلد :attribute تنها می‌تواند شامل حروف و اعداد باشد.',
    'any_of' => 'فیلد :attribute نامعتبر است.',
    'array' => 'فیلد :attribute باید یک آرایه باشد.',
    'ascii' => 'فیلد :attribute تنها می‌تواند شامل کاراکترها و نمادهای تک‌بایتی باشد.',
    'before' => 'فیلد :attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal' => 'فیلد :attribute باید تاریخی قبل یا برابر با :date باشد.',
    'between' => [
        'array' => 'فیلد :attribute باید بین :min و :max مورد داشته باشد.',
        'file' => 'فیلد :attribute باید بین :min و :max کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بین :min و :max باشد.',
        'string' => 'فیلد :attribute باید بین :min و :max کاراکتر باشد.',
    ],
    'boolean' => 'فیلد :attribute باید true یا false باشد.',
    'can' => 'فیلد :attribute شامل یک مقدار غیرمجاز است.',
    'confirmed' => 'تأیید فیلد :attribute مطابقت ندارد.',
    'contains' => 'فیلد :attribute شامل یک مقدار مورد نیاز نیست.',
    'current_password' => 'رمز عبور صحیح نیست.',
    'date' => 'فیلد :attribute باید یک تاریخ معتبر باشد.',
    'date_equals' => 'فیلد :attribute باید تاریخی برابر با :date باشد.',
    'date_format' => 'فیلد :attribute باید با قالب :format مطابقت داشته باشد.',
    'decimal' => 'فیلد :attribute باید :decimal رقم اعشار داشته باشد.',
    'declined' => 'فیلد :attribute باید رد شود.',
    'declined_if' => 'فیلد :attribute باید زمانی رد شود که :other برابر با :value باشد.',
    'different' => 'فیلد :attribute و :other باید متفاوت باشند.',
    'digits' => 'فیلد :attribute باید :digits رقم داشته باشد.',
    'digits_between' => 'فیلد :attribute باید بین :min و :max رقم باشد.',
    'dimensions' => 'ابعاد تصویر فیلد :attribute معتبر نیست.',
    'distinct' => 'فیلد :attribute مقدار تکراری دارد.',
    'doesnt_contain' => 'فیلد :attribute نباید شامل مقادیر :values باشد.',
    'doesnt_end_with' => 'فیلد :attribute نباید با یکی از مقادیر :values پایان یابد.',
    'doesnt_start_with' => 'فیلد :attribute نباید با یکی از مقادیر :values شروع شود.',
    'email' => 'فیلد :attribute باید یک ایمیل معتبر باشد.',
    'encoding' => 'فیلد :attribute باید با انکدینگ :encoding باشد.',
    'ends_with' => 'فیلد :attribute باید با یکی از مقادیر :values پایان یابد.',
    'enum' => ':attribute انتخاب شده معتبر نیست.',
    'exists' => ':attribute انتخاب شده معتبر نیست.',
    'extensions' => 'فیلد :attribute باید یکی از پسوندهای :values باشد.',
    'file' => 'فیلد :attribute باید یک فایل باشد.',
    'filled' => 'فیلد :attribute باید مقدار داشته باشد.',
    'gt' => [
        'array' => 'فیلد :attribute باید بیش از :value مورد داشته باشد.',
        'file' => 'فیلد :attribute باید بزرگتر از :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بزرگتر از :value باشد.',
        'string' => 'فیلد :attribute باید بیش از :value کاراکتر باشد.',
    ],
    'gte' => [
        'array' => 'فیلد :attribute باید حداقل :value مورد داشته باشد.',
        'file' => 'فیلد :attribute باید بزرگتر یا مساوی :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید بزرگتر یا مساوی :value باشد.',
        'string' => 'فیلد :attribute باید بزرگتر یا مساوی :value کاراکتر باشد.',
    ],
    'hex_color' => 'فیلد :attribute باید یک رنگ هگزادسیمال معتبر باشد.',
    'image' => 'فیلد :attribute باید یک تصویر باشد.',
    'in' => ':attribute انتخاب شده معتبر نیست.',
    'in_array' => 'فیلد :attribute باید در :other وجود داشته باشد.',
    'in_array_keys' => 'فیلد :attribute باید حداقل شامل یکی از کلیدهای :values باشد.',
    'integer' => 'فیلد :attribute باید یک عدد صحیح باشد.',
    'ip' => 'فیلد :attribute باید یک آدرس IP معتبر باشد.',
    'ipv4' => 'فیلد :attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6' => 'فیلد :attribute باید یک آدرس IPv6 معتبر باشد.',
    'json' => 'فیلد :attribute باید یک رشته JSON معتبر باشد.',
    'list' => 'فیلد :attribute باید یک لیست باشد.',
    'lowercase' => 'فیلد :attribute باید حروف کوچک باشد.',
    'lt' => [
        'array' => 'فیلد :attribute باید کمتر از :value مورد داشته باشد.',
        'file' => 'فیلد :attribute باید کمتر از :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید کمتر از :value باشد.',
        'string' => 'فیلد :attribute باید کمتر از :value کاراکتر باشد.',
    ],
    'lte' => [
        'array' => 'فیلد :attribute نباید بیش از :value مورد داشته باشد.',
        'file' => 'فیلد :attribute باید کمتر یا مساوی :value کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید کمتر یا مساوی :value باشد.',
        'string' => 'فیلد :attribute باید کمتر یا مساوی :value کاراکتر باشد.',
    ],
    'mac_address' => 'فیلد :attribute باید یک آدرس MAC معتبر باشد.',
    'max' => [
        'array' => 'فیلد :attribute نباید بیش از :max مورد داشته باشد.',
        'file' => 'فیلد :attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute نباید بزرگتر از :max باشد.',
        'string' => 'فیلد :attribute نباید بیش از :max کاراکتر باشد.',
    ],
    'max_digits' => 'فیلد :attribute نباید بیش از :max رقم داشته باشد.',
    'mimes' => 'فیلد :attribute باید از نوع فایل :values باشد.',
    'mimetypes' => 'فیلد :attribute باید از نوع فایل :values باشد.',
    'min' => [
        'array' => 'فیلد :attribute باید حداقل :min مورد داشته باشد.',
        'file' => 'فیلد :attribute باید حداقل :min کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید حداقل :min باشد.',
        'string' => 'فیلد :attribute باید حداقل :min کاراکتر باشد.',
    ],
    'min_digits' => 'فیلد :attribute باید حداقل :min رقم داشته باشد.',
    'missing' => 'فیلد :attribute باید موجود نباشد.',
    'missing_if' => 'فیلد :attribute باید زمانی موجود نباشد که :other برابر با :value باشد.',
    'missing_unless' => 'فیلد :attribute باید موجود نباشد مگر اینکه :other برابر با :value باشد.',
    'missing_with' => 'فیلد :attribute باید زمانی موجود نباشد که :values موجود باشد.',
    'missing_with_all' => 'فیلد :attribute باید زمانی موجود نباشد که همه :values موجود باشند.',

    'multiple_of' => 'فیلد :attribute باید مضربی از :value باشد.',
    'not_in' => ':attribute انتخاب شده معتبر نیست.',
    'not_regex' => 'فرمت فیلد :attribute معتبر نیست.',
    'numeric' => 'فیلد :attribute باید یک عدد باشد.',

    'password' => [
        'letters' => 'فیلد :attribute باید حداقل شامل یک حرف باشد.',
        'mixed' => 'فیلد :attribute باید حداقل شامل یک حرف بزرگ و یک حرف کوچک باشد.',
        'numbers' => 'فیلد :attribute باید حداقل شامل یک عدد باشد.',
        'symbols' => 'فیلد :attribute باید حداقل شامل یک نماد باشد.',
        'uncompromised' => ':attribute وارد شده در نشت اطلاعاتی یافت شده است. لطفاً :attribute دیگری انتخاب کنید.',
    ],

    'present' => 'فیلد :attribute باید وجود داشته باشد.',
    'present_if' => 'فیلد :attribute باید زمانی وجود داشته باشد که :other برابر با :value باشد.',
    'present_unless' => 'فیلد :attribute باید وجود داشته باشد مگر اینکه :other برابر با :value باشد.',
    'present_with' => 'فیلد :attribute باید زمانی وجود داشته باشد که :values موجود باشد.',
    'present_with_all' => 'فیلد :attribute باید زمانی وجود داشته باشد که همه :values موجود باشند.',

    'prohibited' => 'فیلد :attribute مجاز نیست.',
    'prohibited_if' => 'فیلد :attribute زمانی که :other برابر با :value باشد مجاز نیست.',
    'prohibited_if_accepted' => 'فیلد :attribute زمانی که :other پذیرفته شده باشد مجاز نیست.',
    'prohibited_if_declined' => 'فیلد :attribute زمانی که :other رد شده باشد مجاز نیست.',
    'prohibited_unless' => 'فیلد :attribute مجاز نیست مگر اینکه :other در :values باشد.',
    'prohibits' => 'فیلد :attribute مانع از وجود فیلد :other می‌شود.',

    'regex' => 'فرمت فیلد :attribute معتبر نیست.',

    'required' => 'فیلد :attribute الزامی است.',
    'required_array_keys' => 'فیلد :attribute باید شامل کلیدهای :values باشد.',
    'required_if' => 'فیلد :attribute زمانی الزامی است که :other برابر با :value باشد.',
    'required_if_accepted' => 'فیلد :attribute زمانی الزامی است که :other پذیرفته شده باشد.',
    'required_if_declined' => 'فیلد :attribute زمانی الزامی است که :other رد شده باشد.',
    'required_unless' => 'فیلد :attribute الزامی است مگر اینکه :other در :values باشد.',
    'required_with' => 'فیلد :attribute زمانی الزامی است که :values موجود باشد.',
    'required_with_all' => 'فیلد :attribute زمانی الزامی است که همه :values موجود باشند.',
    'required_without' => 'فیلد :attribute زمانی الزامی است که :values موجود نباشد.',
    'required_without_all' => 'فیلد :attribute زمانی الزامی است که هیچ‌یک از :values موجود نباشند.',

    'same' => 'فیلد :attribute باید با :other یکسان باشد.',

    'size' => [
        'array' => 'فیلد :attribute باید شامل :size مورد باشد.',
        'file' => 'فیلد :attribute باید :size کیلوبایت باشد.',
        'numeric' => 'فیلد :attribute باید برابر :size باشد.',
        'string' => 'فیلد :attribute باید :size کاراکتر باشد.',
    ],

    'starts_with' => 'فیلد :attribute باید با یکی از مقادیر :values شروع شود.',
    'string' => 'فیلد :attribute باید یک رشته متنی باشد.',
    'timezone' => 'فیلد :attribute باید یک منطقه زمانی معتبر باشد.',
    'unique' => ':attribute قبلاً ثبت شده است.',
    'uploaded' => 'بارگذاری :attribute با شکست مواجه شد.',
    'uppercase' => 'فیلد :attribute باید با حروف بزرگ باشد.',
    'url' => 'فیلد :attribute باید یک نشانی اینترنتی (URL) معتبر باشد.',
    'ulid' => 'فیلد :attribute باید یک ULID معتبر باشد.',
    'uuid' => 'فیلد :attribute باید یک UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | پیام‌های سفارشی اعتبارسنجی
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'پیام سفارشی',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | نام‌های قابل فهم برای فیلدها
    |--------------------------------------------------------------------------
    */

    'attributes' => [],

];
