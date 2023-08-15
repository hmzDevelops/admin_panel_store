<?php

namespace App\Http\Controllers\admin\market;

use App\Models\User;
use App\Models\Market\Copan;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\AmazingSale;
use App\Http\Controllers\Controller;
use App\Models\Market\CommonDiscount;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\admin\Market\CopanRequest;
use App\Http\Requests\admin\Market\AmazingSaleRequest;
use App\Http\Requests\admin\Market\CommonDiscountRequest;

class DiscountController extends Controller
{

    public function copan()
    {
        $copans = Copan::all();
        return view('admin.market.discount.copan', compact('copans'));
    }

    public function copanCreate()
    {
        $users = User::all();
        return view('admin.market.discount.copan-create', compact('users'));
    }

    public function copanStore(CopanRequest $request)
    {
        $inputs = $request->all();

        $inputs = $request->all();

        //date fix
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);

        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }

        $copan = Copan::create($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'کوپن تخفیف جدید شما با موفقیت ثبت شد');
    }

    public function copanEdit(Copan $copan)
    {
        $users = User::all();
         return view('admin.market.discount.copan-edit', compact('copan','users'));
    }

    public function copanUpdate(CopanRequest $request, Copan $copan)
    {
        $inputs = $request->all();

        //date fix
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);

        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }

        $copan->update($inputs);
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'ویرایش کوپن تخفیف جدید شما با موفقیت ثبت شد');
    }

    public function copanDestroy(Copan $copan)
    {
        $copan->delete();
        // Session::flash('swal-success', "Special message goes here");
        return redirect()->route('admin.market.discount.copan')->with('swal-success', 'کوپن تخفیف شما با موفقیت حذف گردید');
    }

    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::all();
        return view('admin.market.discount.common', compact('commonDiscounts'));
    }


    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-create');
    }

    //ذخیره تخفیف عمومی
    public function store(CommonDiscountRequest $request)
    {
        $inputs = $request->all();

        //date fix
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);

        $commonDiscount = CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف شما با موفقیت ثبت گردید');
    }

    //ویرایش تخفیف عمومی
    public function update(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs = $request->all();

        //date fix
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);

        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف شما با موفقیت ویرایش گردید');
    }


    public function edit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common-edit', compact('commonDiscount'));
    }


    public function destroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
        return redirect()->route('admin.market.discount.commonDiscount')->with('swal-success', 'کد تخفیف شما با موفقیت حذف گردید');
    }




    public function amazingSale()
    {
        $amazingSales = AmazingSale::all();
        return view('admin.market.discount.amazing', compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-create', compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {

        $inputs = $request->all();

        //date fix
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);

        $amazingSale = AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'تخفیف جدید شما با موفقیت ثبت شد');
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-edit', compact('amazingSale', 'products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs = $request->all();

        //date fix
        $realTimestampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date("Y-m-d H:i:s", (int)$realTimestampStart);
        $realTimestampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date("Y-m-d H:i:s", (int)$realTimestampEnd);

        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'تخفیف جدید شما با موفقیت ویرایش شد');
    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale')->with('swal-success', 'کد تخفیف شما با موفقیت حذف گردید');
    }
}
