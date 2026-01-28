<section id="courses" class="bg-emerald-50 dark:bg-zinc-900 py-20">
  <div class="container mx-auto px-6">
    <!-- Page Header -->
    <div class="mb-8 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">All Courses</h2>
      <p class="text-gray-700 dark:text-gray-300 text-lg">Find courses that match your interests</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Filters Column -->
      <aside class="w-full lg:w-1/4 bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-4 text-emerald-700 dark:text-emerald-300">Filters</h3>

        <form method="GET" action="{{ route('courses.index') }}" class="space-y-6">

          <!-- Category Filter -->
          <div>
            <h4 class="font-medium mb-2 text-gray-800 dark:text-gray-200">Category</h4>
            <ul class="space-y-2 max-h-48 overflow-auto pr-2">
              @foreach($categories as $category)
                <li>
                  <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ (is_array(request('categories')) && in_array($category->id, request('categories'))) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $category->name }}</span>
                  </label>
                </li>
              @endforeach
            </ul>
          </div>

          <!-- Price Filter -->
          <div>
            <h4 class="font-medium mb-2 text-gray-800 dark:text-gray-200">Price</h4>
            <ul class="space-y-2">
              <li>
                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                  <input type="radio" name="price" value="free" class="form-radio h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ request('price') === 'free' ? 'checked' : '' }}>
                  <span class="ml-2">Free</span>
                </label>
              </li>
              <li>
                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                  <input type="radio" name="price" value="0-500" class="form-radio h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ request('price') === '0-500' ? 'checked' : '' }}>
                  <span class="ml-2">1 - 500 tk</span>
                </label>
              </li>
              <li>
                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                  <input type="radio" name="price" value="501-1000" class="form-radio h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ request('price') === '501-1000' ? 'checked' : '' }}>
                  <span class="ml-2">501 - 1000 tk</span>
                </label>
              </li>
              <li>
                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                  <input type="radio" name="price" value="1001-2000" class="form-radio h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ request('price') === '1001-2000' ? 'checked' : '' }}>
                  <span class="ml-2">1001 - 2000 tk</span>
                </label>
              </li>
              <li>
                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                  <input type="radio" name="price" value="2001-5000" class="form-radio h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ request('price') === '2001-5000' ? 'checked' : '' }}>
                  <span class="ml-2">2001 - 5000 tk</span>
                </label>
              </li>
              <li>
                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                  <input type="radio" name="price" value=">5000" class="form-radio h-4 w-4 text-emerald-600 dark:text-emerald-400" {{ request('price') === '>5000' ? 'checked' : '' }}>
                  <span class="ml-2">&gt; 5000 tk</span>
                </label>
              </li>
            </ul>
          </div>

          <div class="flex items-center gap-3">
            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded shadow">Apply</button>
            <a href="{{ route('courses.index') }}" class="text-sm text-emerald-600 hover:underline">Reset</a>
          </div>

        </form>
      </aside>

      <!-- Courses Column -->
      <div class="flex-1">
        <!-- Search & Sorting -->
        <form method="GET" action="{{ route('courses.index') }}" class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
          <!-- Carry over existing filters as hidden inputs -->
          @foreach((array) request('categories', []) as $catId)
            <input type="hidden" name="categories[]" value="{{ $catId }}">
          @endforeach
          @if(request('price'))
            <input type="hidden" name="price" value="{{ request('price') }}">
          @endif

          <!-- Search Bar -->
          <input name="search" type="text" placeholder="Search courses..." value="{{ request('search') }}"
                 class="flex-1 border border-gray-300 dark:border-zinc-700 rounded-md px-4 py-2 text-gray-900 dark:text-white bg-white dark:bg-zinc-800 focus:ring-2 focus:ring-emerald-400 focus:outline-none">

          <!-- Sorting -->
          <select name="sort" class="border border-gray-300 dark:border-zinc-700 rounded-md px-4 py-2 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
            <option value="">Sort By</option>
            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
            <option value="price-low" {{ request('sort') === 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price-high" {{ request('sort') === 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
          </select>
        </form>

        <!-- Courses List -->
        <div class="flex flex-col gap-6">
        @foreach($courses as $course)
            <div class="p-4 flex flex-col md:flex-row md:items-start bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">

                <!-- Course Banner -->
                <div class="w-full md:w-48 h-48 overflow-hidden flex-shrink-0">
                    <img src="{{ $course->banner_path ? asset('storage/' . $course->banner_path) : asset('images/default-course.png') }}"
                        alt="{{ $course->title }}"
                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>

                <!-- Course Details -->
                <div class="flex-1 px-6 flex flex-col justify-between">
                    <div>
                        <!-- Title -->
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">{{ $course->title }}</h3>

                        <!-- Description -->
                        <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-3">{{ $course->description }}</p>

                        <!-- Instructor & Modules -->
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <span>Instructor: <span class="font-medium">{{ $course->instructor->name ?? 'N/A' }}</span></span>
                            <span>Modules: <span class="font-medium">{{ $course->modules_count ?? '10' }}</span></span>
                        </div>

                        <!-- Reviews & Students -->
                        <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <div class="flex items-center gap-1">
                            <!-- Dummy 5-star -->
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09L5.4 11.545 1 7.91l6.06-.545L10 2.5l2.94 4.865L19 7.91l-4.4 3.636 1.278 6.545z"/></svg>
                            @endfor
                            <span>(123)</span>
                            </div>
                            <span>{{ $course->enrolled_count ?? '1.2k' }} Students</span>
                        </div>
                    </div>

                </div>
                <!-- Price & View -->
                <div class="flex flex-col items-end gap-3">
                  <div>
                    @if($course->discount)
                      <span class="text-red-500 line-through mr-2">{{ $course->price }} tk</span>
                      <span class="text-emerald-600 dark:text-emerald-400 font-semibold">{{ $course->price - ($course->price * $course->discount / 100) }} tk</span>
                    @else
                      <span class="text-emerald-600 dark:text-emerald-400 font-semibold">{{ $course->price ? $course->price .' tk' : 'Free' }}</span>
                    @endif
                  </div>
                  <a href="{{ route('courses.show', $course->slug) }}"
                     class="bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-3 py-1.5 rounded-md text-sm shadow transition">
                    View
                  </a>
                </div>

            </div>
        @endforeach
        </div>

        <div class="mt-6">{{ $courses->links() }}</div>

      </div>
    </div>
  </div>
</section>
