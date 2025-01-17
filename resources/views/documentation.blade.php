@include('partials.header')
<script type="module" src="{{asset('script/zero-md.js')}}"></script>

<div class="container pt-3" style="font-size: 4rem;">
    <zero-md src="/data/documentation.md"></zero-md>
</div>


@include('partials.footer')
