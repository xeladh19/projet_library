<style>
    .grid-template-header{
        display: grid; 
        grid-template-columns: 1fr;
    }
    .grid-1{
        grid-column: span 1;
    }
    @media screen and (min-width: 768px){
        .grid-template-header{
            display: grid; 
            grid-template-columns: 200px auto 200px;
        }
    }
</style>
<div class="grid-template-header" style="margin-bottom:20px">
    <a href="{{ route('index') }}">
        <div style="width:250px">
            <img src="{{ asset('images/') }}" height="50px" style="">
        </div>    
    </a>
    
</div>
<style>
    .vignette{
        display: block;
        width: 100px;
        margin: auto;
        font-weight: bold;
        font-size:1.2em;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        text-align: center;
        transition: 0.3s;
        color: white;
    }

    #shopVignette{
        color: #d60b52;
        border: 1px solid #d60b52;
    }
    #shopVignette:hover{
        background-color: #d60b52;
        color: white;
    }
    #proVignette{
        color: #2cb396;
        border: 1px solid #2cb396;
    }

    #proVignette:hover{
        background-color: #2cb396;
        color: white;
    }


</style>
