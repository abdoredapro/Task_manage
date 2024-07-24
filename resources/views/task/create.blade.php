<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task') }}
        </h2>
        
    </x-slot>
    


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add Task') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("You can add task.") }}
                            </p>
                        </header>
                    
                    
                    
                        <form method="POST" action="{{ route('dashboard.task.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"  autofocus autocomplete="title" />
                            </div>
                            
                            @error('title')
                                <div class="text text-danger"> {{ $message }} </div>
                            @enderror

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea name="description" id="category" class="form-control"></textarea>
                            </div>

                            @error('description')
                                <div class="text text-danger"> {{ $message }} </div>
                            @enderror

                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select name="category_id" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    
                                </select>

                                @error('category_id')
                                <div class="text text-danger">Category is required.</div>
                                @enderror

                            </div>



                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Add') }}</x-primary-button>
                            </div>
                
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>