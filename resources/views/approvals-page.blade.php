<x-filament-panels::page>
    <div x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-approvals-styles', 'martinpetricko/filament-approvals'))]">
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-4">
            <div class="col-span-1 xl:col-span-3">
                <x-filament::section compact>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-x-3">
                                @if ($this->draft->author)
                                    <x-filament-panels::avatar.user
                                        :user="$this->draft->author"
                                        size="lg"
                                    />
                                @endif

                                <div class="flex items-center gap-x-3">
                                    <div class="flex flex-col">
                                        <span>
                                            {{ __('filament-approvals::approvals.pages.approvals.view.revision_by', ['name' => $this->draft->author?->name ?? __('filament-approvals::approvals.pages.approvals.view.anonymous_user')]) }}
                                        </span>

                                        <small class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ $this->draft->created_at->diffForHumans() }} ({{ $this->draft->created_at->format('d M') }} @ {{ $this->draft->created_at->format('H:i') }})
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <x-filament::badge :color="\MartinPetricko\FilamentApprovals\Helpers\EnumManager::getColor($this->draft->status)">
                                {{ \MartinPetricko\FilamentApprovals\Helpers\EnumManager::getLabel($this->draft->status) }}
                            </x-filament::badge>
                        </div>
                    </x-slot>

                    <div class="flex flex-col gap-5 divide-y divide-gray-200 dark:divide-white/10">
                        @php
                            $diffs = $this->draft->getDiff()->calculateDiffs();
                        @endphp

                        @if(count($diffs) > 0)
                            <div class="flex flex-col gap-5">
                                @foreach ($diffs as $fieldName => $diff)
                                    <div>
                                        <p class="mb-2 px-1 text-lg font-medium capitalize">
                                            {{ Str::headline($fieldName) }}
                                        </p>

                                        {!! $diff !!}
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @foreach($this->relatedDrafts as $relatedDraft)
                            @php
                                $diffs = $relatedDraft->getDiff()->calculateDiffs();

                                if (count($diffs) === 0) {
                                    continue;
                                }
                            @endphp

                            <div class="flex flex-col gap-5 pt-5">
                                <p class="text-xl font-medium">
                                    {{ Str::headline(class_basename($relatedDraft->draftable)) }}: {{ $relatedDraft->draftable->getKey() }}
                                </p>
                                @foreach($diffs as $fieldName => $diff)
                                    <div>
                                        <p class="mb-2 px-1 text-lg font-medium capitalize">
                                            {{ Str::headline($fieldName) }}
                                        </p>

                                        {!! $diff !!}
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </x-filament::section>
            </div>

            <div class="flex flex-col gap-6 col-span-1">
                <x-filament::section compact>
                    <x-slot name="heading">
                        {{ __('filament-approvals::approvals.pages.approvals.view.revisions_list') }}
                    </x-slot>

                    <ol role="list" class="divide-y divide-gray-200 dark:divide-white/10">
                        @foreach ($this->draftsList as $draft)
                            <li wire:click="showDraft({{ $draft->id }})"
                                @class([
                                    'pb-4' => $loop->first && !$loop->last,
                                    'pt-4' => $loop->last && !$loop->first,
                                    'py-4' => !$loop->first && !$loop->last,
                                    'group cursor-pointer',
                                ])
                            >
                                <div class="flex items-center gap-x-2">
                                    @if ($draft->author)
                                        <x-filament-panels::avatar.user
                                            :user="$draft->author"
                                            size="sm"
                                        />
                                    @endif

                                    <span style="flex: 1 1 auto;"
                                        @class([
                                            'text-primary-600' => $draft->id === $this->draft->id,
                                            'flex-auto truncate text-sm font-medium leading-6 group-hover:text-primary-600',
                                        ])
                                    >
                                        <span
                                            @class([
                                                'text-primary-600' => $draft->id === $this->draft->id,
                                                'font-normal text-gray-500 group-hover:text-primary-600 dark:text-gray-400',
                                            ])
                                            title="{{ __('filament-approvals::approvals.pages.approvals.view.revision_by', [
                                                'name' => $draft->author?->name ?? __('filament-approvals::approvals.pages.approvals.view.anonymous_user'),
                                            ]) }}"
                                        >
                                            {{ __('filament-approvals::approvals.pages.approvals.view.revision_by', ['name' => '']) }}
                                        </span>

                                        {{ $draft->author?->name ?? __('filament-approvals::approvals.pages.approvals.view.anonymous_user') }}
                                    </span>

                                    <span class="flex-none text-xs text-gray-500 dark:text-gray-400">
                                        {{ $draft->created_at->diffForHumans(short: true, syntax: Carbon\CarbonInterface::DIFF_ABSOLUTE) }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ol>

                    @if($this->draftsList->hasPages())
                        <div class="mt-4">
                            <x-filament::pagination :paginator="$this->draftsList"/>
                        </div>
                    @endif
                </x-filament::section>

                @if($this->draft->message)
                    <x-filament::section compact>
                        <x-slot name="heading">
                            {{ __('filament-approvals::approvals.pages.approvals.view.message') }}
                        </x-slot>

                        {{ $this->draft->message }}
                    </x-filament::section>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
