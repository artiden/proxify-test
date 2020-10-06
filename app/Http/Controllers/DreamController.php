<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DreamRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDream;
use App\Dream;
use App\User;
use Xsolla\SDK\API\PaymentUI\PaymentUIScriptRenderer;
use Xsolla\SDK\API\XsollaClient;

class DreamController extends Controller
{
    /**
     * A dreams repository
     *
     * @var DreamRepository
     */
    private $repository;

    /**
     * Create a new controller instance.
     *
     * @param DreamRepository $repository
     * @return void
     */
    public function __construct(DreamRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the user's dreams
     *
     * @param User $user
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $userDreams = $this->repository->getUserDreams($user);
        return view('dream.list', [
            'dreams' => $userDreams,
        ]);
    }

    /**
     * Show form to create a new your dream
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function storeForm()
    {
        return view('dream.store');
    }

    /**
     * Store your dream to the database
     *
     * @param StoreDream $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDream $request)
    {
        $dream = $this->repository->storeDream($request);

        return redirect()->route('show_dream', [$dream->id]);
    }

    /**
     * Show selected dream
     *
     * @param Dream $dream
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Dream $dream)
    {
        return view('dream.show', compact('dream'));
    }

    /**
     * An action using for show a pay form or make fake payment. It's depends on a request method.
     *
     * @param Request $request
     * @param Dream $dream
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function pay(Request $request, Dream $dream)
    {
        /**
         * In real application we have a possibility to select a sum usually. It's only for example.
         *
         * @var int $sum
         */
        $sum = 1;

        if (!$request->isMethod('POST')) {
            $xsollaClient = XsollaClient::factory([
                'merchant_id' => 165848,
                'api_key' => '3cddac17a9ac2dace9bb9ebfe0093fbe',
            ]);

            $accessToken = $xsollaClient->createCommonPaymentUIToken(
                90625,
                '2',
                $sandboxMode = true
            );
            //$xsollaScript = PaymentUIScriptRenderer::render($paymentUIToken, $sandboxMode = true);

            return view('dream.pay', compact('dream', 'sum', 'accessToken'));
        }

        $this->repository->pay($dream, $sum);
        return redirect()->route('show_dream', [$dream->id]);
    }

    public function testPay(Request $request, Dream $dream)
    {
        $xsollaClient = XsollaClient::factory([
            'merchant_id' => 165848,
            'api_key' => '3cddac17a9ac2dace9bb9ebfe0093fbe',
        ]);

        $paymentUIToken = $xsollaClient->createCommonPaymentUIToken(
            90625,
            strval($request->user()->id),
            $sandboxMode = true
        );
        //PaymentUIScriptRenderer::send($paymentUIToken, $sandboxMode = true);
        var_dump();
        var_dump($paymentUIToken);
    }
}
