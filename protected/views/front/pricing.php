<section class="bg-secondary dark:bg-gray-800">
    <div class="flex flex-col justify-center items-center pt-20">
        <div class="mb-8 max-w-3xl">
            <h2 class="max-w-xl font-display font-bold mb-3 text-4xl text-center leading-tight">Gabung bersama penjual online di Kelolla</h2>
            <p class="text-center">Pilih paket sesuai kebutuhan Anda, tidak ada biaya tersembunyi</p>
        </div>
        <div class="px-4 w-full mx-auto">
            <div class="react-tabs" data-tabs="true">
                <!-- <ul class="border border-1 border-gray-400 rounded-full p-1 relative flex w-full max-w-md mx-auto" role="tablist">
                    <li index="0" class="w-1/3 h-8 px-2 md:px-6 text-sm md:text-base transition-all duration-150 rounded-full outline-none focus:outline-none flex items-center cursor-pointer justify-center mb-0" role="tab" id="react-tabs-8" aria-selected="false" aria-disabled="false" aria-controls="react-tabs-9">Per Bulan</li>
                    <li index="1" class="w-1/3 h-8 px-2 md:px-6 text-sm md:text-base transition-all duration-150 rounded-full outline-none focus:outline-none flex items-center cursor-pointer justify-center mb-0" role="tab" id="react-tabs-10" aria-selected="false" aria-disabled="false" aria-controls="react-tabs-11">Per 6 Bulan</li>
                    <li index="2" class="w-1/3 h-8 px-2 md:px-6 text-sm md:text-base transition-all duration-150 rounded-full outline-none focus:outline-none flex items-center cursor-pointer justify-center mb-0 bg-primary text-white" role="tab" id="react-tabs-12" aria-selected="true" aria-disabled="false" aria-controls="react-tabs-13" tabindex="0">Per Tahun</li>
                    <img src="../images/disc25.svg" alt="" class="absolute hidden md:block" style="right: -5.75rem; bottom: -1.5rem; width: 120px;">
                </ul> -->
                <div index="0" class="react-tabs__tab-panel" role="tabpanel" id="react-tabs-9" aria-labelledby="react-tabs-8">
                </div>
                <div index="1" class="react-tabs__tab-panel" role="tabpanel" id="react-tabs-11" aria-labelledby="react-tabs-10">

                </div>
                <div index="2" class="react-tabs__tab-panel react-tabs__tab-panel--selected" role="tabpanel" id="react-tabs-13" aria-labelledby="react-tabs-12">
                    <?= $this->renderPartial('tab', []); ?>
                </div>
            </div>
        </div>
    </div>
</section>