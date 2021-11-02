@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

<div>
    <div class="mt-6 grid xl:grid-cols-6 gap-4 lg:gap-6">
        <div class="xl:col-span-4 space-y-5">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 sm:p-5">
                <div>
                    <x-shopper-input.group label="Name" for="name" isRequired :error="$errors->first('name')">
                        <x-shopper-input.text wire:model.lazy="name" id="name" type="text" autocomplete="off" placeholder="Apple, Nike, Samsung..." />
                    </x-shopper-input.group>
                </div>
                <div class="mt-5 border-t border-gray-200 dark:border-gray-700 pt-4">
                    <x-shopper-input.group label="Description" for="description">
                        <livewire:shopper-forms.trix :value="$description" />
                    </x-shopper-input.group>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 sm:p-5 overflow-hidden">
                <h4 class="block text-base font-medium leading-6 text-gray-900 dark:text-white">{{ __('Product Media') }}</h4>
                <div class="mt-4">
                    <x-shopper-input.filepond
                        wire:model="files"
                        multiple
                        allowImagePreview
                        imagePreviewMaxHeight="200"
                        allowFileTypeValidation
                        allowFileSizeValidation
                        maxFileSize="5mb"
                        :images="$images"
                    />
                    @error('files.*')
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow pt-4 sm:pt-5 overflow-hidden">
                <h4 class="block text-base font-medium leading-6 text-gray-900 dark:text-white px-4 sm:px-5">{{ __('Pricing') }}</h4>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="grid gap-4 sm:grid-cols-6 sm:gap-6 p-4 sm:p-5">
                        <x-shopper-input.group for="price_amount" label="Price amount" class="col-span-6 sm:col-span-3">
                            <x-shopper-input.text wire:model="price_amount" id="price_amount" type="number" min="0" autocomplete="off" placeholder="0.00" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">{{ $currency }}</span>
                            </div>
                        </x-shopper-input.group>
                        <x-shopper-input.group for="old_price_amount" label="Compare at price" class="col-span-6 sm:col-span-3">
                            <x-shopper-input.text wire:model="old_price_amount" id="old_price_amount" type="number" min="0" autocomplete="off" placeholder="0.00" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">{{ $currency }}</span>
                            </div>
                        </x-shopper-input.group>
                    </div>
                    <div class="grid grid-cols-6 gap-6 p-4 sm:p-5">
                        <x-shopper-input.group for="cost_amount" label="Cost per item" class="col-span-6 sm:col-span-3" helpText="Customers won’t see this.">
                            <x-shopper-input.text wire:model.lazy="cost_amount" id="cost_amount" type="number" min="0" autocomplete="off" placeholder="0.00" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5">{{ $currency }}</span>
                            </div>
                        </x-shopper-input.group>
                    </div>
                </div>
            </div>
        </div>
        <div class="xl:col-span-2">
            <aside class="space-y-5">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="p-4 sm:p-5">
                        <x-shopper-label value="{{ __('Product status') }}" />
                        <div class="mt-4 px-3 py-2.5 bg-blue-50 rounded-md text-blue-600 flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="h-8 w-8 flex items-center justify-center rounded-md bg-blue-600 flex-shrink-0">
                                    <x-heroicon-o-eye class="h-5 w-5 text-white" />
                                </span>
                                <span class="font-semibold ml-3 text-sm">{{ __('Visible') }}</span>
                            </div>
                            <div>
                                <span wire:model="isVisible" x-data="{ on: @entangle('isVisible') }" role="checkbox" tabindex="0" @click="$dispatch('input', !on); on = !on" @keydown.space.prevent="on = !on" :aria-checked="on.toString()" aria-checked="false" :class="{ 'bg-gray-200 dark:bg-gray-600': !on, 'bg-blue-600': on }" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline-blue bg-gray-200">
                                    <input type="hidden" x-ref="input" aria-label="Visible" x-model="on" />
                                    <span aria-hidden="true" :class="{ 'translate-x-5': on, 'translate-x-0': !on }" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200 translate-x-0"></span>
                                </span>
                            </div>
                        </div>
                        <p class="mt-2 text-gray-500 dark:text-gray-400 leading-5 text-sm">
                            {{ __("This product will be hidden from all sales channels.") }}
                        </p>
                    </div>
                    <div
                        x-data
                        x-init="flatpickr($refs.input, {dateFormat: 'Y-m-d'});"
                        class="p-4 sm:p-5"
                    >
                        <x-shopper-label for="date" :value="__('Product availability')" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-heroicon-o-calendar class="h-5 w-5 text-gray-400" />
                            </div>
                            <input wire:model="publishedAt" x-ref="input" id="date" type="text" class="w-full pl-10 block w-full dark:bg-gray-700 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-md shadow-sm border-gray-300 dark:border-gray-700 focus:border-blue-300 focus:ring focus:ring-blue-300 dark:focus:ring-offset-gray-900 focus:ring-opacity-50 sm:text-sm" placeholder="{{ __('Choose a date') }}" readonly />
                        </div>
                        @if($publishedAt)
                            <div class="mt-2 flex items-start">
                                <div class="mt-1 flex-shrink-0 w-2.5 h-2.5 rounded-full bg-blue-600"></div>
                                <p class="ml-2.5 text-sm text-gray-500 dark:text-gray-400 leading-5">
                                    {{ __('Will be published on:') }} <br>
                                    {{ $publishedAtFormatted }}
                                </p>
                            </div>
                        @else
                            <p class="mt-2 text-sm leading-5 text-gray-500 dark:text-gray-400">
                                {{ __('Specify a publication date so that your product are scheduled on your store.') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-4 pt-4 sm:px-5 sm:pt-5">
                        <h4 class="block text-base font-medium leading-6 text-gray-900 dark:text-white">{{ __('Product associations') }}</h4>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        <x-shopper-input.group class="p-4 sm:p-5" label="Brand" for="brand_id">
                            <x-shopper-input.select wire:model="brand_id" id="brand_id">
                                <option value="0">{{ __('No brand') }}</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </x-shopper-input.select>
                        </x-shopper-input.group>
                        <x-shopper-input.group class="p-4 sm:p-5" label="Collections" for="collections" wire:ignore>
                            <x-shopper-input.select wire:model="collection_ids" id="collections" multiple  x-data="{}" x-init="function () { choices($el) }">
                                @foreach($collections as $collection)
                                    <option value="{{ $collection->id }}" @if(in_array($collection->id, $collection_ids)) selected @endif>{{ $collection->name }}</option>
                                @endforeach
                            </x-shopper-input.select>
                        </x-shopper-input.group>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-4 pt-4 sm:px-5 sm:pt-5">
                        <h4 class="block text-base font-medium leading-6 text-gray-900 dark:text-white">{{ __('Product categories') }}</h4>
                    </div>
                    <div class="px-4 py-3">
                        <div class="space-y-3 p-2 max-h-96 border border-gray-200 rounded-md shadow-sm overflow-scroll hide-scroll dark:border-gray-700">
                            @foreach($categories as $category)
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <x-shopper-input.checkbox id="category-{{ $category->id }}" wire:model="category_ids" value="{{ $category->id }}" />
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="category-{{ $category->id }}" class="font-medium text-gray-700 dark:text-gray-300">{{ $category->name }}</label>
                                    </div>
                                </div>

                                @if($category->childs->isNotEmpty())
                                    <div class="ml-4 space-y-3">
                                        @foreach($category->childs as $child)
                                            @include('shopper::components.input.checkbox-category', ['parent' => $category->parent_id, 'category' => $child])
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-5">
        <div class="flex justify-end">
            <x-shopper-button wire:click="store" wire.loading.attr="disabled" type="button">
                <x-shopper-loader wire:loading wire:target="store" />
                {{ __('Update') }}
            </x-shopper-button>
        </div>
    </div>
</div>
