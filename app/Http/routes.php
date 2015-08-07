<?php
Route::model('classroom',Akademik\Ruangan::class);
Route::model('discliplinecatagory',Akademik\KategoriMataPelajaran::class);
Route::model('disclipline',Akademik\MataPelajaran::class);
Route::model('program',Akademik\Program::class);
Route::model('religion',Akademik\Agama::class);
Route::model('degree',Akademik\Kelas::class);
Route::model('schoolyear',Akademik\TahunAjaran::class);
Route::model('specialneed',Akademik\KebutuhanKhusus::class);
Route::model('pegawai',Akademik\Pegawai::class);
Route::model('tugas',Akademik\PegawaiTugas::class);
Route::model('guru',Akademik\Guru::class);
Route::model('hobi',Akademik\Hobi::class);
Route::model('exkul',Akademik\Eskul::class);



Route::get('/', function () {
	return redirect()->route('sesi.login.form');
});
/**
 *  bagian login system
 */
Route::group(['prefix'=>'sesi','namespace'=>'sesi','as'=>'sesi.','middleware'=>'UserAccessControll:guest'],function ()
{
	Route::get('/',function ()
	{
		return redirect()->route('sesi.login.form');
	});
	Route::get('login',['as'=>'login.form','uses'=>'SesiController@form']);
	Route::post('login',['as'=>'login.send','uses'=>'SesiController@login']);
	Route::get('logout',['as'=>'logout','uses'=>'SesiController@logout']);
});
Route::get("do",['as'=>'pegawai.do',"middleware"=>"UserAccessControll:pegawai",'uses'=>'sesi\SesiController@pegawaiRole']);
Route::post("do",['as'=>'pegawai.do.go',"middleware"=>"UserAccessControll:pegawai",'uses'=>'sesi\SesiController@pegawaiRoleSelect']);

Route::group(['prefix'=>'stafftu','namespace'=>'StaffTu','as'=>'stafftu.','middleware'=>'UserAccessControll:pegawai,stafftu'],function ()
{
	Route::get('/',['as'=>'landing','uses'=>'Landing@page']);
	Route::group(['namespace'=>'MasterData','prefix'=>'masterdata'],function ()
	{
		Route::get('/',['as'=>'index','uses'=>function ()
		{
			return redirect()->route('stafftu.masterdata.classroom.index');
		}]);
		Route::resources([
			'classroom'=>'ClassRoomController',
			'disclipline'=>'DiscliplineController',
			'discliplinecatagory'=>'DiscliplineCatagoryController',
			'program'=>'ProgramController',
			'religion'=>'ReligionController',
			'degree'=>'DegreeController',
			'schoolyear'=>'SchoolYearController',
			'specialneed'=>'SpecialNeedController',
			'exkul'=>'ExkulController',

			]);
	});
	Route::group(['namespace'=>'Kepegawaian','prefix'=>'kepegawaian'],function ()
	{
		Route::get('/',['as'=>'index','uses'=>function ()
		{
			return redirect()->route('stafftu.kepegawaian.pegawai.index');
		}]);
		Route::resources([
			'pegawai'=>'PegawaiController',
			'tugas'=>'TugasController',
			'guru'=>'GuruController',
			'diklat'=>'DiklatController',
			'pendidikan'=>'PendidikanController',
			'pekerjaan'=>'PekerjaanController',
			'masa kerja'=>'MasaKerjaController',
			]);
		
	});
	Route::group(['namespace'=>'Student','prefix'=>'siswa'],function ()
	{
		Route::get('/',['as'=>'index','uses'=>function ()
		{
			return redirect()->route('stafftu.siswa.siswa.index');
		}]);
		Route::resource('class','ClassController');
		Route::resource('siswa','StudentController');
	});

	Route::group(['namespace'=>'Pengaturan','prefix'=>'pengaturan'],function(){
		Route::get('/',['as'=>'index','uses'=>function(){
			return redirect()->route('stafftu.pengaturan.hobi.index');

		}]);
		Route::resources([
			'hobi'=>'HobiController',
			]);

	});
});

Route::group(['prefix'=>'guru','namespace'=>'Guru','as'=>'guru.','middleware'=>'UserAccessControll:pegawai,guru'],function ()
{
	Route::get('/',['as'=>'landing']);
});
Route::group(['prefix'=>'walikelas','namespace'=>'WaliKelas','as'=>'walikelas.','middleware'=>'UserAccessControll:pegawai,walikelas'],function ()
{
	Route::get('/',['as'=>'landing']);
});

Route::group(['prefix'=>'kepalasekolah','namespace'=>'KepalaSekolah','as'=>'kepalasekolah.','middleware'=>'UserAccessControll:pegawai,kepalasekolah'],function ()
{
	Route::get('/',['as'=>'landing']);
});
Route::group(['prefix'=>'administratif','namespace'=>'Administratif','as'=>'administratif.','middleware'=>'UserAccessControll:pegawai,administratif'],function ()
{
	Route::get('/',['as'=>'landing']);
});
