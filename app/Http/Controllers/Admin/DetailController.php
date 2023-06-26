<?php

namespace App\Http\Controllers\Admin;

use App\Charts\TotalVotes;
use App\Http\Controllers\Controller;

use App\Models\Detail;
use App\Models\Spec;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Charts\VoteMonth;



class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detail = Detail::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();

        $specs = Spec::where('title', '!=', $user->mainspec)->get();

        return view('admin.details.create', compact('detail', 'user', 'specs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        $formData = $request->all();

        $this->validation($request);

        $newDetail = new Detail();

        if ($request->hasFile('profile_pic')) {

            $path = Storage::put('profile_pic_folder', $request->profile_pic);

            $formData['profile_pic'] = $path;
        };

        if ($request->hasFile('curriculum')) {

            $path = Storage::put('curriculum_folder', $request->curriculum);

            $formData['curriculum'] = $path;
        };

        $newDetail->fill($formData);
        $newDetail->slug = $user->slug;
        $newDetail->user_id = $user->id;

        $newDetail->save();

        if (array_key_exists('specs', $formData)) {
            $newDetail->specs()->attach($formData['specs']);
        }

        return redirect()->route('admin.details.show', $newDetail->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        $detail = Detail::where('user_id', Auth::id())->first();
        //dd($detail);
        $chartN1 = new TotalVotes;
        $chartN1->labels(['1', '2', '3', '4', '5'])
            ->title('Grafico Voti Totali per Numero Voti')
            ->options([
                'maintainAspectRatio' => false,
                'scales' => [
                    'yAxes' => [
                        [
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Numero Voti'
                            ],
                            'ticks' => [
                                'max' => 8,
                                'beginAtZero' => true,
                                'stepSize' => 1,
                                'precision' => 0
                            ]
                        ]
                    ],
                    'xAxes' => [
                        [
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Voto'
                            ]
                        ]
                    ],
                ],
            ]);

        $userVotes = [];
        for ($i = 1; $i <= 5; $i++) {
            $userVotes[$i] = DB::table('votes')
                ->where([
                    ['user_id', '=', Auth::id()],
                    ['vote', '=', $i]
                ])
                ->count();
        }
        $chartN1->dataset('Voti', 'bar', array_values($userVotes));

        // Grafico n'2
        $chartN2 = new VoteMonth;
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $labels[] = $monthName;
        }

        $chartN2->labels($labels);
        $chartN2->title('Grafico Voti Totali per Mese')
            ->options([
                'maintainAspectRatio' => false,
                'scales' => [
                    'yAxes' => [
                        [
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Numero Voti'
                            ],
                            'ticks' => [
                                'max' => 8,
                                'beginAtZero' => true,
                                'stepSize' => 1,
                                'precision' => 0
                            ]
                        ]
                    ],
                    'xAxes' => [
                        [
                            'scaleLabel' => [
                                'display' => true,
                                'labelString' => 'Mesi'
                            ]
                        ]
                    ],
                ],
            ]);

        $votesByMonth = DB::table('votes')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as vote_count'))
            ->where('user_id', Auth::id())
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
        //dd($votesByMonth);
        $voteCount = '';
        foreach ($votesByMonth as $vote) {
            $month = $vote->month;
            $voteCount = $vote->vote_count;

            // Process the month and vote count as needed
        }

        $chartN2->dataset('Voti', 'bar', [$voteCount]);






        return view('admin.details.show', compact('detail', 'chartN1', 'chartN2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        $user = User::where('id', Auth::id())->first();
        $specs = Spec::where('title', '!=', $user->mainspec)->get();

        return view('admin.details.edit', compact('detail', 'specs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        $formData = $request->all();

        $this->validation($request);

        if ($request->hasFile('profile_pic')) {

            if ($detail->profile_pic) {
                Storage::delete($detail->profile_pic);
            };

            $path = Storage::put('profile_pic_folder', $request->profile_pic);

            $formData['profile_pic'] = $path;
        };

        if ($request->hasFile('curriculum')) {

            if ($detail->curriculum) {
                Storage::delete($detail->curriculum);
            };

            $path = Storage::put('curriculum_folder', $request->curriculum);

            $formData['curriculum'] = $path;
        };

        $detail->update($formData);

        if (array_key_exists('specs', $formData)) {
            $detail->specs()->sync($formData['specs']);
        } else {
            $detail->specs()->detach();
        }

        return redirect()->route('admin.details.show', $detail->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        if ($detail->profile_pic) {
            Storage::delete($detail->profile_pic);
        };

        if ($detail->curriculum) {
            Storage::delete($detail->curriculum);
        };

        $detail->delete();

        return redirect()->route('admin.dashboard');
    }

    private function validation($request)
    {

        $formData = $request->all();

        $validator = Validator::make($formData, [
            'curriculum' => 'nullable|mimes:pdf|max:10240',
            'profile_pic' => 'nullable|image|max:4096',
            'phone_number' => 'required|min:10|max:25',
            'services' => 'required|max:500',
            'specs' => 'exists:specs,id'
        ], [
            'curriculum.mimes' => 'Il file di curriculum deve essere di formato pdf.',
            'curriculum.max' => "Il file di curriculum non può superare i 10MB di grandezza, riprova.",
            'profile_pic.image' => "Il file inserito deve essere un'immagine.",
            'profile_pic.max' => "L'immagine di profilo non può superare i 4MB di grandezza, riprova.",
            'phone_number.required' => "Il numero di telefono è obbligatorio.",
            'phone_number.min' => 'Il numero di telefono deve essere di almeno 10 caratteri.',
            'phone_number.max' => 'Il numero di telefono non può essere più lungo di 25 caratteri.',
            'services.required' => 'Le prestazioni sono obbligatorie.',
            'services.max' => 'Il campo sulle prestazioni non può contenere più di 500 caratteri.',
            'specs.exists' => 'Seleziona le specializzazioni tra quelle qui riportate.',

        ])->validate();

        return $validator;
    }
}
