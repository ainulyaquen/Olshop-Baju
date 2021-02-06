<form role="form" method="POST">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" required="" name="nama">
                                <label>Alamat</label>
                                <textarea type="text" row="2" class="form-control" required="" name="alamat"></textarea>
                                <label>Bagian</label>
                                <select class="form-control" name="jabatan">
                                  <option>Admin</option>
                                  <option>Kasir</option>
                                  <option>Gudang</option>
                                </select>
                            </div>
                            <button type="submit" name="save" class="btn btn-lg btn-success"><i class="fa fa-save"></i> Simpan</button>
                            </form>

                                
                                
                            <?php
                                if(isset($_POST['save']))
                                {
                                  $sql="SELECT max(id_pegawai) as terakhir from tb_pegawai";
                                  $hasil= mysqli_query($db,$sql);
                                  $data= mysqli_fetch_array($hasil);
                                  $lastID= $data['terakhir'];
                                  $lastnourut= (int)substr($lastID,2, 4);
                                  $nextnourut=$lastnourut+1;
                                  $nextID="KR".sprintf("%04s",$nextnourut);
                                  
                                  
                                  $nama=$_POST['nama'];
                                  $alamat=$_POST['alamat'];
                                  $jab=$_POST['jabatan'];
                                  
                                  mysqli_query($db,"INSERT INTO tb_pegawai(id_pegawai,nama_pegawai,alamat,jabatan) 
      VALUES ('$nextID','$nama','$alamat','$jab')");

                                    echo "<script>alert('Data Berhasil Tersimpan')</script>";
                                    echo "<script>window.location='homeadmin.php?halaman=pegawai';</script>";
                                  
                                }
                          ?>