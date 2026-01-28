@extends('layouts.base')

@section('content')
<main class="max-w-7xl mx-auto px-6 lg:px-8 py-16 min-h-screen">
  <div class="grid gap-10 lg:grid-cols-2 items-start">
    {{-- Illustration / Image section --}}
    <div class="flex items-center justify-center">
      <div class="w-full max-w-7xl bg-emerald-50 dark:bg-emerald-900/40 rounded-2xl p-6 shadow-lg">
        {{-- Inline SVG to avoid broken image links and keep design consistent --}}
        <div class="flex items-center justify-center mb-4">
          <div class="relative">
            <img src="{{ asset('images/faq.webp') }}" alt="FAQ Illustration" class="w-132 h-112"/>
            <div class="absolute inset-0 bg-emerald-700/30 mix-blend-multiply pointer-events-none" aria-hidden="true"></div>
          </div>
          {{-- <svg class="w-64 h-48" viewBox="0 0 640 512" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <rect x="0" y="0" width="1024" height="1024" rx="24" fill="#ECFDF5"/>
            <g transform="translate(60,40)">
              <rect x="0" y="0" width="520" height="160" rx="12" fill="#ffffff"/>
              <rect x="20" y="20" width="360" height="20" rx="6" fill="#10B981"/>
              <rect x="20" y="52" width="420" height="12" rx="6" fill="#6EE7B7"/>
              <rect x="20" y="76" width="300" height="12" rx="6" fill="#A7F3D0"/>
              <g transform="translate(0,200)">
                <rect x="0" y="0" width="520" height="180" rx="12" fill="#fff"/>
                <circle cx="60" cy="60" r="40" fill="#10B981"/>
                <rect x="120" y="30" width="360" height="16" rx="8" fill="#D1FAE5"/>
                <rect x="120" y="60" width="240" height="12" rx="6" fill="#ECFDF5"/>
              </g>
            </g>
          </svg> --}}
        </div>
        <h4 class="text-center text-2xl font-semibold text-emerald-700 dark:text-emerald-300">Have questions about learning with us?</h4>
        <p class="mt-3 text-center text-lg text-gray-600 dark:text-gray-300">Explore common topics about enrollment, payments, certificates, and support.</p>
      </div>
    </div>

    {{-- FAQ content --}}
    <section>
      <header class="mb-6">
        <h1 class="text-3xl font-extrabold text-emerald-700 dark:text-emerald-400">Frequently Asked Questions</h1>
        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Common questions about courses, accounts, payments, and platform features.</p>
      </header>

      <style>
        /* Hide the inner scrollbar but keep scrolling functional */
        #faq-accordion { scrollbar-width: none; }
        #faq-accordion::-webkit-scrollbar { display: none; }

        /* Smooth collapse/expand for answer panels */
        .faq-panel { max-height: 0; overflow: hidden; transition: max-height 350ms cubic-bezier(.2,.8,.2,1), opacity 250ms ease; will-change: max-height, opacity; opacity: 0; }
        .faq-panel.open { opacity: 1; }
        .chev { transition: transform 300ms cubic-bezier(.2,.8,.2,1); }
      </style>

      <div id="faq-accordion" class="space-y-4 max-h-[60vh] lg:max-h-[70vh] overflow-y-auto pr-2 pb-8">
        {{-- Use accessible details/summary for accordion behavior --}}
        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">How do I enroll in a course?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">Visit the course page and click the <strong>Enroll</strong> button. For paid courses, complete checkout. Some instructor-led or moderated courses may require approval—you'll receive an email if approval is needed.</div>
        </details>

        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">What payment methods do you accept?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">We accept major credit/debit cards and a selection of local payment providers depending on your region. Receipts and invoices are available after purchase.</div>
        </details>

        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">Will I get a certificate after completion?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">Many courses offer a certificate of completion. Check the course details for certificate availability and any requirements such as passing grades or final projects.</div>
        </details>

        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">What are the technical requirements?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">You’ll need a modern browser (Chrome, Firefox, Edge, Safari) and a stable internet connection. Some video content may adapt quality automatically. For assignments, recommended tools are listed on the course page.</div>
        </details>

        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">Can I get a refund?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">Refunds are handled per-course. Policy details are available on the course page or in your order confirmation. Contact support if you believe you qualify for a refund.</div>
        </details>

        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">How do I become an instructor?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">Apply via the Become an Instructor link. Our team reviews applications and will contact you with onboarding steps, guidelines, and publishing options.</div>
        </details>

        <details class="group border border-gray-200 dark:border-gray-800 rounded-lg p-4 bg-white dark:bg-gray-900">
          <summary class="flex items-center justify-between cursor-pointer list-none">
            <span class="text-left text-sm font-medium text-gray-900 dark:text-gray-100">Do you offer group or corporate discounts?</span>
            <svg class="w-5 h-5 text-gray-400 chev" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </summary>
          <div class="faq-panel mt-3 text-sm text-gray-700 dark:text-gray-300">Yes — we offer group licensing and enterprise plans. Contact our sales team via the Contact page to discuss volume pricing and LMS integration options.</div>
        </details>

      </div>

      {{-- Ensure only one details is open at a time, and keep accordion scrollable so footer isn't pushed down --}}
      <script>
        (function () {
          const container = document.getElementById('faq-accordion');
          if (!container) return;
          const details = Array.from(container.querySelectorAll('details'));

          function animateOpen(panel, open) {
            if (!panel) return;
            if (open) {
              // prepare for transition
              panel.classList.add('open');
              panel.style.maxHeight = '0px';
              // force style flush then set to scrollHeight
              requestAnimationFrame(() => {
                panel.style.maxHeight = panel.scrollHeight + 'px';
              });
            } else {
              // close smoothly
              panel.style.maxHeight = panel.scrollHeight + 'px';
              requestAnimationFrame(() => {
                panel.style.maxHeight = '0px';
                panel.classList.remove('open');
              });
            }
          }

          function openDetail(target) {
            details.forEach((d) => {
              const panel = d.querySelector('.faq-panel');
              const chev = d.querySelector('.chev');
              if (d === target) {
                if (!d.open) d.open = true;
                animateOpen(panel, true);
                if (chev) chev.style.transform = 'rotate(180deg)';
              } else {
                if (d.open) d.open = false;
                animateOpen(panel, false);
                const otherChev = d.querySelector('.chev');
                if (otherChev) otherChev.style.transform = 'rotate(0deg)';
              }
            });
            // ensure visible
            const rect = target.getBoundingClientRect();
            const containerRect = container.getBoundingClientRect();
            if (rect.bottom > containerRect.bottom || rect.top < containerRect.top) {
              target.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
          }

          // Attach handlers to summaries for smooth control and keyboard accessibility
          details.forEach((el) => {
            const summary = el.querySelector('summary');
            const panel = el.querySelector('.faq-panel');
            const chev = el.querySelector('.chev');

            // initialize
            if (panel) panel.style.maxHeight = el.open ? panel.scrollHeight + 'px' : '0px';
            if (chev) chev.style.transform = el.open ? 'rotate(180deg)' : 'rotate(0deg)';

            if (summary) {
              summary.addEventListener('click', (e) => {
                e.preventDefault();
                if (el.open) {
                  el.open = false;
                  animateOpen(panel, false);
                  if (chev) chev.style.transform = 'rotate(0deg)';
                } else {
                  openDetail(el);
                }
              });

              summary.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                  e.preventDefault();
                  summary.click();
                }
              });
            }
          });
        })();
      </script>

      <div class="mt-6 text-sm">
        <p class="text-gray-600 dark:text-gray-300">Still have questions? <a href="/contact" class="font-medium text-emerald-600 dark:text-emerald-300 hover:underline">Contact support</a> or visit the <a href="/help" class="font-medium text-emerald-600 dark:text-emerald-300 hover:underline">Help Center</a>.</p>
      </div>
    </section>
  </div>
</main>
@endsection
