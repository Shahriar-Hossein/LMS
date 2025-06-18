<div class="flex relative justify-center items-center  min-h-screen overflow-hidden">
    <div class="w-full md:w-1/2 h-screen flex items-center justify-center bg-[url('/public/images/study.png')]  bg-cover bg-center lg:bg-gradient-to-l from-cyan-200 to-emerald-300 p-8 z-1">
        <div class="md:hidden backdrop-blur-sm bg-emerald-500/30 absolute inset-0"> </div>
        <div class="flex flex-col max-w-md text-gray-950 z-1">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                Build or Upgrade Your Skills
            </h1>
            <p class="text-lg mb-6">
                Welcome to <span class="font-semibold text-gray-950">SkillUp</span> — where there's something for everyone, from students to working professionals.
            </p>
            <a href="#"
            class="h-12 w-34 inset-ring-emerald-900 text-nowrap hover:-translate-y-1 inline-block bg-gradient-to-l from-cyan-600 to-emerald-600 text-gray-100 font-semibold px-6 py-3 mb-4 rounded-md shadow hover:from-emerald-600 transition duration-400 ease-in drop-shadow-lg">
            Get Started
            </a>
            <div class="flex flex-col lg:flex-row flex-nowrap items-start items-center text-md py-2 gap-x-6 gap-y-2">
                <div class="flex items-center gap-4">
                    <x-icons.icon-hat class="w-8 h-8 fill-emerald-700 md:fill-blue-900 " />
                    <span class="text-nowrap">1M+ Students</span>
                </div>
                <div class="flex items-center gap-4">
                    <x-icons.icon-course class="w-8 h-8 stroke-emerald-700 md:stroke-blue-900" />
                    <span class="text-nowrap">2K+ Courses</span>
                </div>
                <div class="flex items-center gap-4">
                    <x-icons.icon-teacher class="w-8 h-8 fill-emerald-700 md:fill-blue-900" />
                    <span class="text-nowrap">20K+ Instructors</span>
                </div>
            </div>

        </div>
    </div>
    <div class="hidden md:flex relative w-1/2">
        <div class="hidden md:block absolute self-end rotate-90 -right-30 w-screen">
            <x-icons.icon-wave-divider class="fill-cyan-200" />
        </div>
        <img class="min-h-screen object-cover" src="{{ asset('images/study.png') }}" />
    </div>
    <div class="absolute inset-x-0 bottom-0 z-2">
        <svg viewBox="0 0 224 12" fill="currentColor" class="-mb-1 w-full text-cyan-50" preserveAspectRatio="none">
        <path d="M0,0 C48.8902582,6.27314026 86.2235915,9.40971039 112,9.40971039 C137.776408,9.40971039 175.109742,6.27314026 224,0 L224,12.0441132 L0,12.0441132 L0,0 Z"></path>
        </svg>
    </div>
</div>
