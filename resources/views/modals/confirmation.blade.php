<!-- Confirmation Modal -->
<div id="confirm-modal" tabindex="-1" class="tw-hidden tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-50 tw-p-4 tw-overflow-x-hidden tw-overflow-y-auto md:tw-inset-0 tw-h-full tw-max-h-full tw-flex tw-items-center tw-justify-center tw-backdrop-blur-sm tw-bg-black/30">
    <div class="tw-relative tw-w-full tw-max-w-md tw-max-h-full">
        <div class="tw-relative tw-bg-white tw-rounded-lg tw-shadow dark:tw-bg-gray-700">
            <button type="button" class="tw-absolute tw-top-3 tw-right-2.5 tw-text-gray-400 tw-bg-transparent hover:tw-bg-gray-200 hover:tw-text-gray-900 tw-rounded-lg tw-text-sm tw-w-8 tw-h-8 tw-ml-auto tw-inline-flex tw-justify-center tw-items-center dark:hover:tw-bg-gray-600 dark:hover:tw-text-white" data-modal-hide="confirm-modal">
                <svg class="tw-w-3 tw-h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="tw-p-6 tw-text-center">
                <svg class="tw-mx-auto tw-mb-4 tw-text-gray-400 tw-w-12 tw-h-12 dark:tw-text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="tw-mb-5 tw-text-lg tw-font-normal tw-text-gray-500 dark:tw-text-gray-400">Are you sure you want to proceed with this <span id="confirm-type">appointment</span>?</h3>
                <button id="confirm-yes" type="button" data-modal-hide="confirm-modal" data-modal-target="success-modal" data-modal-toggle="success-modal" class="tw-text-white tw-bg-[#24CFF4] hover:tw-bg-[#63e4fd] focus:tw-ring-4 focus:tw-outline-none focus:tw-ring-blue-300 tw-font-medium tw-rounded-lg tw-text-sm tw-inline-flex tw-items-center tw-px-5 tw-py-2.5 tw-text-center tw-mr-2">
                    Yes, I'm sure
                </button>
            </div>
        </div>
    </div>
</div>