<div class="card overflow-hidden">
                <h5 class="card-header">Pemeriksaan Kesehatan Gigi</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Urutan</th>
                        <th>Posisi Gigi</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                     @foreach ($gigi as $g )
                        <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><i class="icon-base ti tabler-dental-broken me-2"></i>{{$g->jenis}}</td>
                                <td><span class="badge bg-label-primary me-1">{{$g->urutan}}</span></td>
                                <td><span class="badge bg-label-success me-1">{{$g->posisi}}</span></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-warning" onclick="edit('{{ Crypt::encrypt($g->id) }}')"><i class="icon-base ti tabler-edit icon-sm me-1_5"></i> Edit</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="hapus('{{ Crypt::encrypt($g->id) }}')"><i class="icon-base ti tabler-trash icon-sm me-1_5"></i> Hapus</a>
                                </td>
                        </tr>
                     @endforeach
                    
                   
                    
                    </tbody>
                  </table>
                </div>
              </div>