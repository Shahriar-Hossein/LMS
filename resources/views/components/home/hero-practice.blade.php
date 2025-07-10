<div class="flex relative justify-center items-center min-h-screen overflow-hidden">
    <div class="w-full md:w-1/2 h-screen flex items-center justify-center bg-gradient-to-l from-cyan-200 to-emerald-300 p-8 relative z-10">
        <div class="max-w-md text-gray-900">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Build or Upgrade Your Skills
            </h1>
            <p class="text-lg mb-6">
                Welcome to <span class="font-semibold text-gray-950">SkillUp</span> — where there's something for everyone, from students to working professionals.
            </p>
            <a href="#"
            class="hover:-translate-y-1 inline-block bg-gradient-to-l from-cyan-600 to-emerald-600 text-gray-100 font-semibold px-6 py-3 mb-4 rounded-md shadow hover:from-emerald-600 transition duration-400 ease-in drop-shadow-lg">
            Get Started
            </a>
            <div class="flex flex-nowrap items-center text-md py-2 gap-x-6 gap-y-2">
                <div class="flex items-center gap-2">
                    <x-icons.icon-hat class="w-8 h-8 fill-blue-900" />
                    <span class="text-nowrap">1M+ Students</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-icons.icon-course class="w-8 h-8 fill-blue-900 stroke-blue-900" />
                    <span class="text-nowrap">2K+ Courses</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-icons.icon-teacher class="w-8 h-8 fill-blue-900" />
                    <span class="text-nowrap">20K+ Instructors</span>
                </div>
            </div>

        </div>
    </div>
    <!-- Wave Divider (SVG) -->
    <div class="hidden md:block w-12 absolute rotate-90 z-1 min-w-screen">
        <svg
            class="fill-cyan-200"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 320"
        >
            <path
                fill=""
                fill-opacity="1"
                d="M0,224L24,192C48,160,96,96,144,69.3C192,43,240,53,288,101.3C336,149,384,235,432,245.3C480,256,528,192,576,181.3C624,171,672,213,720,218.7C768,224,816,192,864,154.7C912,117,960,75,1008,64C1056,53,1104,75,1152,122.7C1200,171,1248,245,1296,234.7C1344,224,1392,128,1416,80L1440,32L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"
            >
            </path>
        </svg>
    </div>
    <div class="min-h-screen w-2/3">
        <img class="min-h-screen object-cover" src="{{ asset('images/study.png') }}" />
    </div>
</div>
