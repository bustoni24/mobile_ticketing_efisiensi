<div class="h-16 md:h-24 py-4 flex flex-wrap items-center justify-between max-w-6xl px-4 mx-auto">
              <a aria-current="page" class="" href="<?= Constant::baseUrl().'/'; ?>">
                <div class="flex items-center">
                <h1 class="main-title color-primary"><?= Constant::PROJECT_NAME ?></h1>
                </div>
              </a>
              <button class="items-center block h-auto px-3 py-2 rounded md:hidden">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-200 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </button>
              <nav class="hidden md:block md:items-center w-full md:w-auto" id="navbar-header">
              <a href="javascript:void(0);" data-href="#feature"
              rel="noreferrer"
                  class="text-sm px-4 py-2 text-gray-700 hover:text-gray-100 dark:bg-gray-200 hover:bg-gray-800 dark:hover:bg-gray-600 cta_notification-bar md:ml-4 md:mr-0 font-sans text-center w-auto font-medium tracking-wide rounded-md mr-2 transition-all ease-in duration-75 break-words">
                      Fitur
                  </a>
                  <a href="<?= Constant::baseUrl().'/pricing' ?>"
                  rel="noreferrer"
                  class="text-sm px-4 py-2 text-gray-700 hover:text-gray-100 dark:bg-gray-200 hover:bg-gray-800 dark:hover:bg-gray-600 cta_notification-bar md:ml-4 md:mr-0 font-sans text-center w-auto font-medium tracking-wide rounded-md mr-2 transition-all ease-in duration-75 break-words harga">
                      Harga
                  </a>
                <a
                  href="<?= Constant::baseUrl().'/register' ?>"
                  target="_blank"
                  rel="noreferrer"
                  class="text-sm px-4 py-2 text-gray-700 hover:text-gray-700 color-secondary cta_notification-bar md:ml-4 md:mr-0 font-sans text-center w-auto font-medium tracking-wide rounded-md mr-2 transition-all ease-in duration-75 break-words"
                  >Daftar Gratis
                </a>
                <a
                  href="<?= Constant::baseUrl().'/login' ?>"
                  rel="noreferrer"
                  class="text-sm px-4 py-2 text-gray-700 hover:text-gray-100 bg-secondary dark:bg-gray-200 hover:bg-gray-800 dark:hover:bg-gray-600 cta_notification-bar md:ml-4 md:mr-0 font-sans text-center w-auto font-medium tracking-wide rounded-md mr-2 transition-all ease-in duration-75 break-words"
                  >Login
                </a>
                
                <div class="block md:hidden my-4">
                 <!--  <a href="#" class="menu_top block text-xl md:text-base text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 transition-all ease-in duration-75no-underline md:mt-0 md:ml-6 font-sans"
                    >Solusi Bisnis Online</a
                  > -->
                 <!--  <div class="mb-3">
                    <a class="menu_top block ml-4 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 transition-all ease-in duration-75 no-underline leading-loose font-sans" href="order-management/index.html"
                      >Order Management</a
                    ><a class="menu_top block ml-4 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 transition-all ease-in duration-75 no-underline leading-loose font-sans" href="inventory-management/index.html"
                      >Inventory Management</a
                    ><a class="menu_top block ml-4 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 transition-all ease-in duration-75 no-underline leading-loose font-sans" href="shipping-management/index.html"
                      >Shipping Management</a
                    ><a
                      class="menu_top block ml-4 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 transition-all ease-in duration-75 no-underline leading-loose font-sans"
                      href="marketplace-integration/index.html"
                      >Marketplace Integration</a
                    ><a class="menu_top block ml-4 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 transition-all ease-in duration-75 no-underline leading-loose font-sans" href="storefront/index.html"
                      >Ngorder Storefront</a
                    >
                  </div> -->
                  <!-- <a class="menu_top block text-xl md:text-base text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 no-underline md:mt-0 md:ml-6 font-sans" href="seller-story/index.html">Seller Story</a
                  > -->
                  <a class="menu_top block text-xl md:text-base text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 no-underline md:mt-0 md:ml-6 font-sans" href="pricing/index.html">Harga</a
                  >
                  <!-- <a
                    href="https://blog.ngorder.id/"
                    class="menu_top block text-xl md:text-base text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-gray-100 no-underline md:mt-0 md:ml-6 font-sans"
                    target="_blank"
                    rel="noreferrer"
                    >Inspirasi</a
                  > -->
                  <div class="mt-4">
                    <a
                      href="<?= Constant::baseUrl().'/register' ?>"
                      target="_blank"
                      rel="noreferrer"
                      class="text-sm px-4 py-2 text-blue-100 hover:text-blue-100 bg-primary hover:bg-blue-800 menu_top md:ml-4 md:mr-0 font-sans text-center w-auto font-medium tracking-wide rounded-md mr-2 transition-all ease-in duration-75 break-words"
                      >Daftar Gratis</a
                    ><a
                      href="<?= Constant::baseUrl().'/login' ?>"
                      target="_blank"
                      rel="noreferrer"
                      class="text-sm px-4 py-2 text-gray-700 hover:text-gray-100 bg-gray-100 dark:bg-gray-200 hover:bg-gray-800 dark:hover:bg-gray-600 menu_top md:ml-4 md:mr-0 font-sans text-center w-auto font-medium tracking-wide rounded-md mr-2 transition-all ease-in duration-75 break-words"
                      >Login</a
                    >
                  </div>
                </div>
              </nav>
            </div>