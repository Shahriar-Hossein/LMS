<section id="categories" class="py-16 bg-gray-50 dark:bg-zinc-900">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <!-- Heading -->
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white">
        Explore Categories
      </h2>
      <p class="mt-2 text-gray-600 dark:text-gray-400">
        Browse courses by category and start learning today
      </p>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($categories as $category)
        {{-- <a href="{{ route('courses.category', $category->slug) }}" --}}
        <a href="{{ route('home') }}"
           class="group bg-white dark:bg-zinc-800 shadow-md rounded-xl p-6 flex flex-col items-center justify-center transition hover:shadow-xl hover:-translate-y-1">

          <!-- Icon (placeholder or from DB) -->
          <div class="w-14 h-14 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
            <i class="fas fa-book-open text-xl"></i>
          </div>

          <!-- Category Title -->
          <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">
            {{ $category->name }}
          </h3>

          <!-- Course count -->
          <p class="text-sm text-gray-500 dark:text-gray-400">
            {{-- {{ $category->courses_count ?? $category->courses()->count() }} Courses --}}
            x Courses
          </p>

          <!-- Student count -->
          <p class="text-sm text-gray-500 dark:text-gray-400">
            {{-- {{ $category->students_count ?? $category->students()->count() }} Students --}}
            x Enrolled Students
          </p>
        </a>
      @endforeach
    </div>
  </div>
</section>
