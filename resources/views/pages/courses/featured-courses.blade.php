<section class="bg-emerald-50 dark:bg-zinc-900 py-20">
  <div class="container mx-auto px-6">
    <!-- Section Header -->
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
        Featured Courses
      </h2>
      <p class="text-gray-700 dark:text-gray-300 text-lg">
        Learn from expert instructors across various categories and level up your skills.
      </p>
    </div>

    <!-- Courses Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($courses as $course)
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">

          <!-- Banner -->
          <div class="h-48 w-full overflow-hidden">
            <img src="{{ $course->banner_path ? asset('storage/' . $course->banner_path) : asset('images/default-course.png') }}"
                 alt="{{ $course->title }}"
                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
          </div>

          <!-- Course Details -->
          <div class="p-5 flex flex-col flex-1">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
              {{ $course->title }}
            </h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-3 text-sm">
              {{ $course->description }}
            </p>

            <!-- Price & Discount -->
            <div class="flex items-center justify-between mt-auto">
              <div class="flex items-center space-x-1">
                @if($course->discount > 0)
                  <span class="text-sm font-medium text-gray-400 line-through dark:text-gray-500">
                    {{ $course->price ? $course->price . ' tk' : 'Free' }}
                  </span>
                  <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                    {{ $course->price - ($course->price * $course->discount / 100) }} tk
                  </span>
                @else
                  <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                    {{ $course->price ? $course->price . ' tk' : 'Free' }}
                  </span>
                @endif
              </div>

              <!-- View Button -->
              <a href="{{ route('courses.show', $course->slug) }}"
                 class="bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-3 py-1.5 rounded-md text-sm shadow transition">
                View
              </a>
            </div>
          </div>

        </div>
      @endforeach
    </div>

    <!-- Load More / All Courses -->
    <div class="text-center mt-12">
      <a href="#courses"
         class="bg-cyan-600 hover:bg-cyan-700 dark:bg-cyan-500 dark:hover:bg-cyan-600 text-white px-6 py-3 rounded-md text-lg font-semibold shadow transition">
        View All Courses
      </a>
    </div>
  </div>
</section>
