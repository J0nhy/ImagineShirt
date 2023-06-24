<?php
$iterator=0;
$valorTotal=0;
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/select2/select2.min.js"></script>
		<script>
			$(".js-select2").each(function(){
				$(this).select2({
					minimumResultsForSearch: 20,
					dropdownParent: $(this).next('.dropDownSelect2')
				});
			})
		</script>
	<!--===============================================================================================-->
		<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script>
			$('.js-pscroll').each(function(){
				$(this).css('position','relative');
				$(this).css('overflow','hidden');
				var ps = new PerfectScrollbar(this, {
					wheelSpeed: 1,
					scrollingThreshold: 1000,
					wheelPropagation: false,
				});

				$(window).on('resize', function(){
					ps.update();
				})
			});
		</script>
	<!--===============================================================================================-->
		<script src="js/main.js"></script>


<script>

	function changeTotal($id)
	{

		var objTotal = document.querySelector('#total' + $id);
		var valTotal = $('#total'+ $id).text();
		valTotal = valTotal.split("€");

		var objValorTotal = document.querySelector('#valorTotal');
		var txtValTotal = $('#valorTotal').text();
		var txtValTotal = txtValTotal.split("€");

		somaValTotal = txtValTotal[0];
		somaValTotal -= valTotal[0];

		var price = $('#price'+ $id).text();
		price = price.split("€");

		var qty = document.querySelector('#qty' + $id);

		subTotalVal = price[0] * qty.value;
		objTotal.innerHTML = subTotalVal + ".00€";

		somaValTotal += subTotalVal;
		objValorTotal.innerHTML = somaValTotal + ".00€";

        var objSomaTotal = document.querySelector('#valSomaTotal');
        objSomaTotal.value = somaValTotal;
	}
	function changeQty($op, $id)
	{
		var qty = document.querySelector('#qty' + $id);
		if($op == "-"){
			if(qty.value > 1){
				qty.value--;
				changeTotal($id);
			}
		}else{
			if(qty.value < 50){
				qty.value++;
				changeTotal($id);
			}
		}
	}
	function expandirImagem(img) {
		var imagem = document.querySelector(img);
		var popup = document.querySelector('.popup');
		var popupImage = document.querySelector('.popup-image');

		// Define a imagem expandida
		popupImage.src = imagem.src;

		// Exibe o pop-up
		popup.style.display = 'flex';
	}

	function fecharPopUp() {
		var popup = document.querySelector('.popup');
		popup.style.display = 'none';
	}
</script>
@extends('layout')
@section('main')

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="/" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
	<form class="cart-form bg0 p-t-75 p-b-85 background" method="POST" action="checkout">
        @csrf <!-- {{ csrf_field() }} -->
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
                        @if (!empty($cart))
						<div class="wrap-table-shopping-cart tablesBG">
							<table class="table-shopping-cart">
								<tr class="table_head" style="border-top: 0px solid transparent;">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-6"></th>
								</tr>
								@foreach($cart as $item)
								<tr class="table_row" style="border-bottom: 0px solid transparent;">
										<td class="column-1">
											<div class="how-itemcart1" onclick="expandirImagem('#img<?= $iterator; ?>')" title="Click to Preview">
												<img src="storage/tshirt_images/{{$item["image_url"]}}" class="card-img-top center" alt="{{ $item["image_url"] }}" id="img<?= $iterator; ?>">
											</div>
											<!-- Pop-up -->
											<div class="popup" onclick="fecharPopUp()">
												<div class="popup-content">
                                                    <img id="baseTshirt" src="/tshirt_base/{{ $item["colorCode"] }}.png" alt="IMG-PRODUCT" style="width: 80%; height: 80%; max-height: none;object-fit: contain; position:absolute; z-index: 1;">
                                                    <div style="height: 350px; width: 300px;  position:absolute; z-index: 2; top: 50%; left: 50.5%; transform: translate(-52%,-50%);">
                                                        <img id="fotoTshirt"src="storage/tshirt_images/{{$item["image_url"]}}" alt="IMG-PRODUCT" style="object-fit: cover; max-width:215px; max-height:410px;" class="popup-image">
                                                    </div>
                                                </div>
											</div>
										</td>
										<td class="column-2"><b><?= $item["name"]; ?></b><br><?= $item["cor"]; ?><br><?= $item["size"]; ?></td>
										<td id="price<?= $iterator; ?>" class="column-3"><?= $item["own"] == "True" ? $price[0]->unit_price_own : $price[0]->unit_price_catalog; ?>€</td>
										<td class="column-4">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div onclick="changeQty('-', '<?= $iterator; ?>')" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>

												<input onchange="changeTotal('<?= $iterator; ?>')" class="mtext-104 cl3 txt-center num-product" type="number" id="qty<?= $iterator; ?>" name="qty<?= $iterator; ?>" value="<?= $item["qtd"]; ?>" min="1" max="50">

												<div onclick="changeQty('+', '<?= $iterator; ?>')" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
										</td>
										<td id="total<?= $iterator; ?>" class="column-5"><?= $item["own"] == "True" ? $price[0]->unit_price_own : $price[0]->unit_price_catalog; ?>€</td>
										<td class="column-6"><a class="linkBranco" href="/removeFromCart/{{$item["image_url"]}}{{$item["cor"]}}{{$item["size"]}}"><i class="zmdi zmdi-close iconBigger"></i></a></td>
								</tr>
								<?php
									echo "<script>changeTotal('".$iterator."');</script>";
                                    $valorTotal += ($item["own"] == "True" ? $price[0]->unit_price_own : $price[0]->unit_price_catalog)*$item["qtd"];
									$iterator++;
								?>
								@endforeach
							</table>
						</div>
                        @endif
                        @if (empty($cart))
                        <h3>O seu carrinho está vazio.</h3>
                         @endif
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="flex-w flex-sb-m p-t-18 p-b-15 p-lr-40 p-lr-15-sm" id="coupon">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

							<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
								Apply coupon
							</div>
						</div>

					</div>
					<div id="checkout" class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Nº Artigos:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									<?= $iterator; ?>
								</span>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
								<input type="hidden" id="valSomaTotal" name="total" value="<?= $valorTotal; ?>">
							</div>

							<div class="size-209 p-t-1">
								<span id="valorTotal" class="mtext-110 cl2">
									<?= $valorTotal; ?>.00€
								</span>
							</div>
						</div>
						@if (Auth::user())
						@if (!empty($cart))
						<button class="flex-c-m stext-101 cl2 size-116 bg8 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
							Proceed to Checkout
						</button>
                         @endif

						@else
							<a class="flex-c-m stext-101 cl2 size-116 bg8 bor14 hov-btn3 p-lr-15 trans-04 pointer" href="{{ route('login') }}">Login</a>
                        @endif

					</div>
				</div>
			</div>
		</div>
	</form>



<?php

?>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
	@endsection
</body>
</html>
