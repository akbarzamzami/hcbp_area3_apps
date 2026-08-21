@props(['title', 'subtitle' => '', 'button' => null, 'headers' => [], 'rows' => []])
<div class="rounded-2xl bg-white border border-slate-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold">{{ $title }}</h2>
            <p class="text-sm text-slate-500">{{ $subtitle }}</p>
        </div>@if($button)<button class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">{{ $button }}</button>@endif
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-[1200px] w-full text-left text-xs">
            <thead class="bg-[#31599b] text-white">
                <tr>@foreach($headers as $header)<th class="px-4 py-4 font-semibold">{{ $header }}</th>@endforeach</tr>
            </thead>
            <tbody class="divide-y divide-slate-100">@forelse($rows as $row)<tr>@foreach($row as $value)<td class="px-4 py-4{{ $loop->first ? ' font-medium' : '' }}">{{ $value }}</td>@endforeach</tr>@empty<tr>
                    <td class="px-4 py-8 text-center text-slate-500" colspan="{{ count($headers) }}">Belum ada data.</td>
                </tr>@endforelse</tbody>
        </table>
    </div>
</div>