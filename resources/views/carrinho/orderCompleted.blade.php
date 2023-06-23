 @extends('layout')
 @section('main')
     <div class="checkout-container">
         <!-- breadcrumb -->
         <div class="container">
             <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                 <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                     Home
                     <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                 </a>

                 <span class="stext-109 cl4">
                     Encomenda Concluída
                 </span>
             </div>
         </div>

         <div class="center">
            <br><br>
            <h2 class="linkBranco">A sua encomenda <b>#<?=$orderId?></b> foi concluída e aguarda confirmação de pagamento.</h2><br><br><br>
            <h3 class="linkBranco">Pode Obter a <b>fatura PDF</b> <a href="/pdf/<?=$orderId?>">Aqui</a></h3><br><br><br><br><br><br>
            <h3 class="linkBranco">Obrigado por comprar na <b>ImagineShirt</b>!</h3>
         </div>
         
         </body>

         </html>
     @endsection
