<footer class="bg-gradient-to-r from-emerald-300 via-cyan-200 to-emerald-200 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 border-t border-emerald-400/20 dark:border-zinc-700">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
    
    <!-- Main Footer Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-8">
      
      <!-- Brand Column -->
      <div class="space-y-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
          <img src="https://tecdn.b-cdn.net/img/logo/te-transparent-noshadows.webp" class="h-8" alt="SkillUp Logo" />
          <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">SkillUp</span>
        </a>
        <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
          Empowering learners worldwide with high-quality education. Build or upgrade your skills with expert instructors and industry-relevant courses.
        </p>
        <div class="flex space-x-4 pt-2">
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white transition-all hover:scale-110">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-cyan-600 hover:bg-cyan-700 dark:bg-cyan-500 dark:hover:bg-cyan-600 text-white transition-all hover:scale-110">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white transition-all hover:scale-110">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-cyan-600 hover:bg-cyan-700 dark:bg-cyan-500 dark:hover:bg-cyan-600 text-white transition-all hover:scale-110">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Links</h3>
        <ul class="space-y-3">
          <li>
            <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Home
            </a>
          </li>
          <li>
            <a href="{{ route('courses.index') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              All Courses
            </a>
          </li>
          <li>
            <a href="#categories" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Categories
            </a>
          </li>
          <li>
            <a href="{{ route('about') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              About Us
            </a>
          </li>
          <li>
            <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Become an Instructor
            </a>
          </li>
        </ul>
      </div>

      <!-- Support -->
      <div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Support</h3>
        <ul class="space-y-3">
          <li>
            <a href="{{ route('help') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Help Center
            </a>
          </li>
          <li>
            <a href="{{ route('faq') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              FAQ
            </a>
          </li>
          <li>
            <a href="{{ route('terms') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Terms & Conditions
            </a>
          </li>
          <li>
            <a href="{{ route('privacy') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Privacy Policy
            </a>
          </li>
          <li>
            <a href="{{ route('contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition flex items-center gap-2">
              <i class="fas fa-chevron-right text-xs"></i>
              Contact Us
            </a>
          </li>
        </ul>
      </div>

      <!-- Contact & Newsletter -->
      <div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Stay Connected</h3>
        <ul class="space-y-3 mb-6">
          <li class="flex items-start gap-3 text-gray-700 dark:text-gray-300">
            <i class="fas fa-envelope text-emerald-600 dark:text-emerald-400 mt-1"></i>
            <span class="text-sm">info@skillup.com</span>
          </li>
          <li class="flex items-start gap-3 text-gray-700 dark:text-gray-300">
            <i class="fas fa-phone text-emerald-600 dark:text-emerald-400 mt-1"></i>
            <span class="text-sm">+1 (555) 123-4567</span>
          </li>
          <li class="flex items-start gap-3 text-gray-700 dark:text-gray-300">
            <i class="fas fa-map-marker-alt text-emerald-600 dark:text-emerald-400 mt-1"></i>
            <span class="text-sm">123 Learning St, Education City</span>
          </li>
        </ul>
        
        <!-- Newsletter -->
        <div class="space-y-2">
          <p class="text-sm font-semibold text-gray-900 dark:text-white">Subscribe to Newsletter</p>
          <form class="flex flex-col sm:flex-row gap-2">
            <input 
              type="email" 
              placeholder="Your email" 
              class="flex-1 px-4 py-2 rounded-lg border border-emerald-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
            />
            <button 
              type="submit" 
              class="px-4 py-2 rounded-lg bg-gradient-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-semibold text-sm transition shadow-md hover:shadow-lg whitespace-nowrap">
              Subscribe
            </button>
          </form>
        </div>
      </div>

    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-8 mb-8 border-t border-b border-emerald-400/30 dark:border-zinc-700">
      <div class="text-center">
        <div class="flex items-center justify-center gap-2 mb-1">
          <x-icons.icon-hat class="w-6 h-6 fill-emerald-600 dark:fill-emerald-400" />
          <h4 class="text-2xl font-bold text-gray-900 dark:text-white">1M+</h4>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400">Active Students</p>
      </div>
      <div class="text-center">
        <div class="flex items-center justify-center gap-2 mb-1">
          <x-icons.icon-course class="w-6 h-6 stroke-emerald-600 dark:stroke-emerald-400" />
          <h4 class="text-2xl font-bold text-gray-900 dark:text-white">2K+</h4>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400">Quality Courses</p>
      </div>
      <div class="text-center">
        <div class="flex items-center justify-center gap-2 mb-1">
          <x-icons.icon-teacher class="w-6 h-6 fill-emerald-600 dark:fill-emerald-400" />
          <h4 class="text-2xl font-bold text-gray-900 dark:text-white">20K+</h4>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400">Expert Instructors</p>
      </div>
      <div class="text-center">
        <div class="flex items-center justify-center gap-2 mb-1">
          <i class="fas fa-trophy text-emerald-600 dark:text-emerald-400 text-xl"></i>
          <h4 class="text-2xl font-bold text-gray-900 dark:text-white">100K+</h4>
        </div>
        <p class="text-sm text-gray-600 dark:text-gray-400">Certificates Issued</p>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6">
      <p class="text-sm text-gray-600 dark:text-gray-400 text-center md:text-left">
        &copy; {{ date('Y') }} <span class="font-semibold text-emerald-700 dark:text-emerald-400">SkillUp</span>. All rights reserved.
      </p>
      <div class="flex items-center gap-4">
        <span class="text-xs text-gray-500 dark:text-gray-500">Made with</span>
        <svg class="w-4 h-4 text-red-500 animate-pulse" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5 18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
        <span class="text-xs text-gray-500 dark:text-gray-500">for learners worldwide</span>
      </div>
    </div>

  </div>
</footer>
