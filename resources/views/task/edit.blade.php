<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
        
    </x-slot>
    


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Edit Task') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("You can Edit task.") }}
                            </p>
                        </header>
                    
                    
                    
                        <form method="POST" action="{{ route('dashboard.task.update', $task->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" value="{{ $task->title }}" class="mt-1 block w-full"  autofocus autocomplete="title" />
                            </div>
                            
                            @error('title')
                                <div class="text text-danger"> {{ $message }} </div>
                            @enderror

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea name="description"  id="category" class="form-control">{{ $task->description }}</textarea>
                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select name="category_id" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($task->category_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>


                            <div>
                                <x-input-label :value="__('Status')" />
                                <div class="form-group">
                                    <input type="radio"  name="status" id="pending" value="pending" @checked($task->status == 'pending')> 
                                    <label for="pending">Pending</label>
                                </div>

                                <div class="form-group">
                                    <input type="radio" name="status" id="completed" value="completed" @checked($task->status == 'completed')>
                                    <label for="completed">Completed</label>
                                </div>
                            </div>



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