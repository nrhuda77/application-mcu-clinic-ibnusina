<div class="card overflow-hidden">
                <h5 class="card-header">Score Napfa</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Score</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-dark">

                        <tr >
                                <td>1</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Sit Reach Forward</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->sit_reach_forward}}</span></td>
                            
                        </tr>

                        <tr>
                                <td>2</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Sit Up</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->sit_up}}</span></td>
                            
                        </tr>

                        <tr>
                                <td>3</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Push Up</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->push_up}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>4</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Standing Board Jump</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->standing_board_jump}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>5</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Shuttle Run</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->shuttle_run}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>6</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Rockport</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->rockport}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>7</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Rockport 2</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->rockport2}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>8</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Sit Reach Forward</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_sit_reach_forward}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>9</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Sit Up</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_sit_up}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>10</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Push Up</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_push_up}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>11</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Standing Board Jump</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_standing_board_jump}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>12</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Shuttle Run</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_shuttle_run}}</span></td>
                            
                        </tr>
                        <tr>
                                <td>13</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Rockport</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_rockport}}</span></td>
                            
                        </tr>

                         @php
    $all = $data->score_all; // total score
    $scores = [$data->sit_reach_forward, $data->sit_up, $data->push_up, $data->standing_board_jump, $data->shuttle_run, $data->rockport, $data->rockport2, $data->score_sit_reach_forward, $data->score_sit_up, $data->score_push_up, $data->score_standing_board_jump, $data->score_shuttle_run, $data->score_rockport];
    $status = '';
    $color = '';

    if ($all >= 27) {
        if (in_array(2, $scores) || in_array(3, $scores)) {
            $status = "Baik";
            $color = "bg-success";
        } else {
            $status = "Sangat Baik";
            $color = "bg-success";
        }
    } elseif ($all >= 21) {
        if (in_array(1, $scores) || in_array(2, $scores)) {
            $status = "Rata Rata";
            $color = "bg-warning";
        } else {
            $status = "Baik";
            $color = "bg-success";
        }
    } elseif ($all >= 15) {
        if (in_array(1, $scores)) {
            $status = "Kurang";
            $color = "bg-danger";
        } else {
            $status = "Rata Rata";
            $color = "bg-warning";
        }
    } elseif ($all >= 9) {
        $status = "Kurang";
        $color = "bg-danger";
    } elseif ($all > 5) {
        $status = "Sangat Kurang";
        $color = "bg-danger";
    } else {
        $status = "Tidak Valid";
        $color = "bg-secondary";
    }
@endphp


                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-center">
                                    Total Score
                                </td>
                                 <td colspan="3" class="text-center text-white {{ $color }}">
                                    {{ $data->score_all }}
                                </td>
                                 <td colspan="3" class="text-center text-white {{ $color }}">
                                    {{  $status }}
                                </td>
                            </tr>
                        </tfoot>

                        

                     
                    
                   
                    
                    </tbody>
                  </table>
                </div>
              </div>