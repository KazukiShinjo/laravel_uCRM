<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Service\AnalysisService;
use App\Service\DecileService;
use App\Service\RFMService;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        $subQuery = Order::betweenDate($request->startDate, $request->endDate);

        if ($request->type === 'perDay') {
            // ここでServiceのAnalysisServiceのperDayメソッドを呼び出し、返ってきたデータを$data、$labels、$totalsに格納する
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        }

        if ($request->type === 'perMonth') {
            // ここでServiceのAnalysisServiceのperMonthメソッドを呼び出し、返ってきたデータを$data、$labels、$totalsに格納する
            list($data, $labels, $totals) = AnalysisService::perMonth($subQuery);
        }

        if ($request->type === 'perYear') {
            // ここでServiceのAnalysisServiceのperYearメソッドを呼び出し、返ってきたデータを$data、$labels、$totalsに格納する
            list($data, $labels, $totals) = AnalysisService::perYear($subQuery);
        }

        if ($request->type === 'decile') {
            // ここでServiceのAnalysisServiceのperYearメソッドを呼び出し、返ってきたデータを$data、$labels、$totalsに格納する
            list($data, $labels, $totals) = DecileService::decile($subQuery);
        }

        if ($request->type === 'rfm') {
            // ここでServiceのRFMServiceのrfmメソッドを呼び出し、返ってきたデータを$data、$labels、$totalsに格納する
            list($data, $totals, $eachCount) = RFMService::rfm($subQuery, $request->rfmPrms);

            // Ajax通信なので、JSON形式でレスポンスを返す
            return response()->json(
                [
                    'data' => $data,
                    'type' => $request->type,
                    'eachCount' => $eachCount,
                    'totals' => $totals
                ],
                Response::HTTP_OK
            );
        }
        // Ajax通信なので、JSON形式でレスポンスを返す
        return response()->json(
            [
                'data' => $data,
                'type' => $request->type,
                'labels' => $labels,
                'totals' => $totals
            ],
            Response::HTTP_OK
        );
    }
}
