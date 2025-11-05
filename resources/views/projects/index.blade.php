<x-layout>
    <div class="flex flex-col p-8 justify-start items-start space-y-4">
        @foreach($projects as $key => $value)

        <div class="border-1 rounded-lg p-2 w-[80%]">
            <h1 class="text-xl font-bold"> {{ $value->name }} </h1>
            <div>
                <span class="text-xs">{{ $value->description}}</span>
            </div>
        </div>

        @endforeach
    </div>



</x-layout>
