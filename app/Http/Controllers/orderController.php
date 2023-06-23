<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class orderController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(orders::class, 'encomenda');
    }

    public function index(Request $request): View
    {
        //$allEncomendas = orders::paginate(10);
        //return view('admin.encomendas.index')->with('encomendas', $allEncomendas);

        if(Auth::user()->user_type == 'A'){
            $encomendas = orders::paginate(10);
        $allOrders = orders::all();
        $filterByStatus = $request->status ?? '';
        $filterByCostumerID = $request->CostumerID ?? '';
        $filterByDate = $request->date ?? '';


        $orderQuery = orders::query();


        if ($filterByStatus !== '') {
            $orderQuery->where('status', $filterByStatus);
        }

        if ($filterByCostumerID !== '') {
            $encomendas = orders::where('customer_id', 'like', "%$filterByCostumerID%")->pluck('id');
            $orderQuery->whereIntegerInRaw('id', $encomendas);
        }

        if ($filterByDate !== '') {
            $encomendas = orders::where('created_at', 'like', "%$filterByDate%")->pluck('id');
            $orderQuery->whereIntegerInRaw('id', $encomendas);
        }



        // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
        $encomendas = $orderQuery->paginate(10);

        }elseif(Auth::user()->user_type == 'E'){
            $encomendas = orders::paginate(10);
            $allOrders = orders::all();

            $filterByStatus = $request->status ?? '';
            $filterByCostumerID = $request->CostumerID ?? '';






            $orderQuery = orders::query();

            if ($filterByStatus !== '') {
                $orderQuery->where('status', $filterByStatus);
            }

            if ($filterByCostumerID !== '') {
                $encomendas = orders::where('customer_id', 'like', "%$filterByCostumerID%")->pluck('id');
                $orderQuery->whereIntegerInRaw('id', $encomendas);
            }

            $statuses = ['paid', 'pending'];
                $orderQuery->whereIn('status', $statuses);

            // ATENÇÃO: Comparar estas 2 alternativas com Laravel Telescope
            $encomendas = $orderQuery->paginate(10);
        }




        return view('admin.encomendas.index', compact(
            'filterByStatus',
            'encomendas',
            'allOrders',
            'filterByCostumerID'
        ));

    }


    public function show(orders $encomenda): View
    {
        //dd(strtok($categoria, '-'));
        //$cor = colors::findOrFail($cor);
        if(Auth::user()->user_type == 'E'){
            if($encomenda->status == 'canceled' || $encomenda->status == 'closed'){
                return abort(403, 'This Action is Unauthorized.');
            }else{
                return view('admin.encomendas.show')->with('encomenda', $encomenda);
            }
        }else{
            return view('admin.encomendas.show')->with('encomenda', $encomenda);
        }

        //return view('admin.cores.show', compact('cores'));

    }

    public function paid(string $user): RedirectResponse
    {

        try{
            $orderToChange = orders::where('id','=' ,$user)->first();

            if($orderToChange->status == 'pending'){
                $orderToChange->status = 'paid';

                $orderToChange->save();
                return redirect()->route('encomendas.index')->with('message', "Encomenda alterada com sucesso.");
            }
            else
             return redirect()->route('encomendas.index')->with('message', "ERRO: Não foi possivel aterar a encomenda.");





        } catch (\Throwable $th) {
            return redirect()->route('encomendas.index')->with('message', "ERRO: Não foi possivel aterar a encomenda.");
        }


    }

    public function closed(string $user): RedirectResponse
    {
        try{
            $orderToChange = orders::where('id','=' ,$user)->first();


            $orderToChange->status = 'closed';

            $orderToChange->save();

            return redirect()->route('encomendas.index')->with('message', "User restaurado com sucesso.");

        } catch (\Throwable $th) {
            return redirect()->route('encomendas.index')->with('message', "ERRO: Não foi possivel restaurar o user.");
        }



    }
    public function canceled(string $user): RedirectResponse
    {
        try{
            $orderToChange = orders::where('id','=' ,$user)->first();


            $orderToChange->status = 'canceled';

            $orderToChange->save();

            return redirect()->route('encomendas.index')->with('message', "User restaurado com sucesso.");

        } catch (\Throwable $th) {
            return redirect()->route('encomendas.index')->with('message', "ERRO: Não foi possivel restaurar o user.");
        }



    }
}
