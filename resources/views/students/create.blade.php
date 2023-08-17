@include('partials.__header', [$title])

<header class="max-w-lg mx-auto">
    <a href="#">
        <h1 class="text-4xl font-bold text-white text-center">Add New Student</h1>
    </a>
</header>
<main class="bg-white max-w-lg mx-auto p-8 my-10 rounded-lg shadow-2xl">

    <section class="mt-10">
        <form action="/add/student" method="POST" class="flex flex-col" enctype="multipart/form-data">
            @csrf
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                    First Name</label>
                    <input type="text" name="first_name" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400
                    px-3" autocomplete="off" value={{old('first_name')}}>   

                        @error('first_name')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>  
         @enderror             
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                    Last Name</label>
                    <input type="text" name="last_name" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400
                    px-3" autocomplete="off"  value={{old('last_name')}}>   
                        
                        @error('last_name')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>  
         @enderror 
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="gender" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                    Gender</label>
                    <select name="gender" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400
                    px-3" autocomplete="off"> 

                    <option value="" {{old('gender') == "" ? 'selected' : ''}}></option>
                    <option value="Male" {{old('gender') == "Male" ? 'selected' : ''}}>Male</option>
                    <option value="Female" {{old('gender') == "Female" ? 'selected' : ''}}>Female</option>
                
                     </select> 
                     
                        @error('gender')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>  
          @enderror 
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="age" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                    Age</label>
                    <input type="number" name="age" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400
                    px-3"  value={{old('age')}}>  
                    
                        @error('age')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>  
         @enderror 
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                    Email</label>
                    <input type="email" name="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400
                    px-3" autocomplete="off"  value={{old('email')}}>  
                    
                        @error('email')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>  
         @enderror 
            </div>

            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label for="student_image" class="block text-gray-700 text-sm font-bold mb-2 ml-3">
                    Student Image</label>
                    <input type="file" name="student_image" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-400
                    px-3" autocomplete="off">  
                    
                        @error('student_image')
                        <p class="text-red-500 text-xs p-1">
                            {{$message}}
                        </p>  
         @enderror 
            </div>

            
            
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">
                Add new
            </button>
        </form>
    </section>
</main>


@include('partials.__footer')