{{-- resources/views/laporan/partials/footer.blade.php --}}
<div class="footer">
    Dicetak pada: {{ date('d/m/Y H:i') }} oleh {{ auth()->user()->name ?? 'System' }}
</div>
