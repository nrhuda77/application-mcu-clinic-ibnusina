<div class="card overflow-hidden">
                <h5 class="card-header">Jakarta Cardiovascular</h5>
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
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Gender</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->gender}}</span></td>
                            
                        </tr>

                        <tr>
                                <td>2</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Age</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->age}}</span></td>
                            
                        </tr>

                        <tr>
                                <td>3</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Blood Presure</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->blood_presure}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>4</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>BMI</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->bmi}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>5</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Smoking</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->smoking}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>6</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Diabetes</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->diabetes}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>7</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Activity</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->activity}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>8</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Gender</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_gender}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>9</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Age</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_age}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>10</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Blood Presure</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_blood_presure	}}</span></td>
                            
                        </tr>

                         <tr>
                                <td>11</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Bmi</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_bmi}}</span></td>
                            
                        </tr>

                        <tr>
                                <td>12</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Smoking</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_smoking}}</span></td>
                            
                        </tr>

                        <tr>
                                <td>13</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Diabetes</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_diabetes}}</span></td>
                            
                        </tr>
                        <tr>
                                <td>14</td>
                                <td><i class="icon-base ti tabler-shareplay me-2"></i>Score Activity</td>
                                <td class="text-center"><span class="badge bg-label-primary me-1">{{$data->score_activity}}</span></td>
                            
                        </tr>

                  

                         @php
    $all = $data->score_all; // total score
    $status = '';
    $color = '';

    if ($all<= 18 && $all  >= 5) {
            $status = "High Risk (CV10 > 20%)";
            $color = "bg-danger";

    } elseif ($all <= 4 && $all >= 2) {
            $status = "Moderate Risk (CV10 = 10-20%)";
            $color = "bg-warning";

    } elseif ($all <= 1) {
            $status = "Low Risk (CV10 < 10%)";
            $color = "bg-success";
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