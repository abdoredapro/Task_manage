<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
        
    </x-slot>
    


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Category') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("You can now edit category.") }}
                            </p>
                        </header>
                    
                    
                    
                        <form method="post" action="{{ route('dashboard.category.update', $category->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input  name="user_id" type="hidden" value="{{ Auth::id() }}"   />
                                <x-text-input id="name" name="name" value="{{ $category->name }}" type="text" class="mt-1 block w-full"  autofocus autocomplete="name" />
                            </div>
                            
                            @error('name')
                                <div class="text text-danger"> {{ $message }} </div>
                            @enderror

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>
                
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>