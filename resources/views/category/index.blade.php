<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Category') }}
        </h2>
        
    </x-slot>

    <div class="py-12 cayegory">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="head">
                        <div>
                            <h1>All Category</h1>
                        </div>
                        <div class="control">
                            <a class="btn btn-sm btn-primary" href="{{ route('dashboard.category.create') }}">Create</a>
                        </div>
                    </div>
                    
                    <div class="show">
                        <div class="row">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-sm btn-primary mr-5" href="{{ route('dashboard.category.edit', $category->id) }}">Edit</a>
                                            <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-sm btn-danger" value="DELETE"> 
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    

                    {{{  $categories->links() }}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>