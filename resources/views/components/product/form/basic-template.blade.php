@props(['url'])
<div {{ $attributes->class(['min-h-screen flex flex-col sm:justify-center items-center']) }}>
    <div class="w-full max-w-xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form method="POST" action={{$url}}>
            {{$slot}}
            <x-validation-errors class="mb-4" :errors="$errors" />
        </form>
    </div>
</div>
