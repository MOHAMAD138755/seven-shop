<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>جزعیات سفارش</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex min-h-screen items-center justify-center px-4 py-10">

    <div class="w-full max-w-2xl overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-gray-100">

        <section class="px-6 pb-8 pt-10 text-center sm:px-10">

            <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
                <i class="fa-solid fa-check text-3xl text-green-600"></i>
            </div>

            <h1 class="text-2xl font-bold text-green-800 sm:text-3xl">
                پرداخت با موفقیت انجام شد
            </h1>

            <p class="mt-3 text-sm leading-6 text-gray-500">
                سفارش شما با موفقیت ثبت شد و در حال پردازش است.
            </p>

        </section>


        <section class="border-y border-gray-100 bg-gray-50/70 px-6 py-6 sm:px-10">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                <div>
                    <span class="text-sm text-gray-500">
                        شماره سفارش
                    </span>

                    <p class="mt-1 font-bold text-gray-900">
                        {{ $order->id }}
                    </p>
                </div>

                <div>
                    <span class="text-sm text-gray-500">
                        وضعیت سفارش
                    </span>

                    <p class="mt-1 font-bold text-green-600">
                        {{ $order->status }}
                    </p>
                </div>

                <div>
                    <span class="text-sm text-gray-500">
                        مبلغ پرداختی
                    </span>

                    <p class="mt-1 font-bold text-gray-900">
                        {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($order->total_price / 10) : number_format($order->total_price)}}
                    </p>
                </div>

                <div>
                    <span class="text-sm text-gray-500">
                        شماره پیگیری
                    </span>

                    <p class="mt-1 font-bold text-gray-900">
                        {{ $order->ref_id ?? '---' }}
                    </p>
                </div>

            </div>

        </section>


        <section class="px-6 py-6 sm:px-10">

            <h2 class="mb-4 text-base font-bold text-gray-900">
                محصولات سفارش
            </h2>

            <div class="space-y-3">

                @forelse($order->items as $item)
                <article class="flex items-center justify-between gap-4 rounded-xl border border-gray-100 p-4">

                    <div class="flex min-w-0 items-center gap-3">

                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($item->product->image) }}"
                            alt="محصول"
                            class="h-14 w-14 shrink-0 rounded-lg object-cover"
                        >

                        <div class="min-w-0">

                            <h3 class="truncate font-semibold text-gray-900">
                                {{ $item->product->name }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                تعداد: {{ $item->quantity }}
                            </p>

                        </div>

                    </div>

                    <span class="shrink-0 text-sm font-bold text-gray-900">
                        {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format(($item->price * $item->quantity) / 10) : number_format($item->price * $item->quantity)}}
                    </span>

                </article>
                @empty
                    <p>محصولی وجود ندارد</p>
                @endforelse

            </div>

        </section>


        <section class="border-t border-gray-100 px-6 py-6 sm:px-10">

            <h2 class="mb-4 text-base font-bold text-gray-900">
                اطلاعات ارسال
            </h2>

            <dl class="space-y-3 text-sm">

                <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">

                    <dt class="text-gray-500">
                        گیرنده
                    </dt>

                    <dd class="font-semibold text-gray-900">
                        {{ $order->receiver_name }}
                    </dd>

                </div>


                <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">

                    <dt class="text-gray-500">
                        شماره تماس
                    </dt>

                    <dd class="font-semibold text-gray-900">
                        {{ $order->phone_number }}
                    </dd>

                </div>


                <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">

                    <dt class="text-gray-500">
                        آدرس
                    </dt>

                    <dd class="font-semibold leading-6 text-gray-900 sm:max-w-md sm:text-left">
                        {{ $order->address }}
                    </dd>

                </div>

            </dl>

        </section>

        <footer class="flex flex-col gap-3 border-t border-gray-100 px-6 py-6 sm:flex-row sm:justify-center sm:px-10">

            <a
                href="{{ url('/') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-green-500 w-[80%] py-3 text-sm font-semibold text-white transition hover:bg-green-600"
            >
                بازگشت به فروشگاه
            </a>

        </footer>

    </div>

</div>
</body>
</html>

