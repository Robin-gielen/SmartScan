package com.example.arnog.mlkittextrecognize;

import android.Manifest;
import android.content.ContentValues;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.net.Uri;
import android.provider.MediaStore;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.core.content.ContextCompat;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.util.SparseArray;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.google.android.gms.vision.Frame;
import com.google.android.gms.vision.text.TextBlock;
import com.google.android.gms.vision.text.TextRecognizer;
import com.theartofdev.edmodo.cropper.CropImage;
import com.theartofdev.edmodo.cropper.CropImageView;

import androidx.core.app.ActivityCompat;

public class MainActivity extends AppCompatActivity {

    EditText mResultEt;
    ImageView mPreviewIv;

    private static final int CAMERA_REQUEST_CODE = 200;
    private static final int STORAGE_REQUEST_CODE = 400;
    private static final int IMAGE_PICK_GALLERY_CODE = 1000;
    private static final int IMAGE_PICK_CAMERA_CODE = 1001;

    String cameraPermission[];
    String storagePermission[];

    Uri image_uri;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        ActionBar actionBar = getSupportActionBar();
        actionBar.setSubtitle("cliquer sur l'icône d'image pour choisir un mode de scan");

       mResultEt = findViewById(R.id.resultEt);
       mPreviewIv = findViewById(R.id.imageIv);

       // Permission sur la camera
        cameraPermission = new String[]{Manifest.permission.CAMERA,
                Manifest.permission.WRITE_EXTERNAL_STORAGE};
        //Permission sur le stockage
        storagePermission = new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE};
    }

    // Barre d'actions du menu
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        //menu "gonflant"
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }






    // Gère les clics des divers éléments présents dans la barre d'action
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();
        if (id == R.id.addImage){
            showImageImportDialog();
        }
        if (id == R.id.settings){
            Toast.makeText(this, "Settings", Toast.LENGTH_SHORT).show();
        }
        return super.onOptionsItemSelected(item);
    }

    // Gère la boîte de dialogue
    private void showImageImportDialog() {
        //éléments à afficher dans la boîte de dialogue
        String[] items = {"Appareil Photo", "Galerie"};
        AlertDialog.Builder dialog = new AlertDialog.Builder(this);
        // placer le titre
        dialog.setTitle("Sélectionner un mode de scan");
        dialog.setItems(items, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                if (which == 0){
                    // Option de la camera choisie
                    // pour Android Marshmallow et supérieur, demande d'autorisation d'exécution pour la caméra et le stockage
                    if (!checkCameraPermission()){
                        // Si permission d'accès à la caméra pas autorisée, le demander
                        requestCameraPermission();
                    }
                    else {
                        // Permission d'accès à la caméra autorisée, prendre la photo
                        pickCamera();
                    }
                }
                if (which == 1){
                    // Option de la bibliothèque de photos choisie
                    if (!checkStoragePermission()){
                        // Si permission d'accès au stockage de l'appareil, le demander
                        requestStoragePermission();
                    }
                    else{
                        // Permission accordée
                        pickGallery();
                    }
                }
            }
        });
        dialog.create().show(); //Fais apparaître la boîte de dialogue
    }

    // Photo prise depuis la galerie
    private void pickGallery() {
        //Intention de prendre une image de la bibliothèque de l'appareil
        Intent intent = new Intent(Intent.ACTION_PICK);
        //Définir le type de l'intent à l'image
        intent.setType("image/*");
        startActivityForResult(intent, IMAGE_PICK_GALLERY_CODE);
    }

    // Photo prise depuis l'appareil photo
    private void pickCamera() {
        //Intention de prendre l'image depuis l'appareil photo, il sera également enregistré sur le stockage de l'appareil pour obtenir une image de haute qualité
        ContentValues values = new ContentValues();
        values.put(MediaStore.Images.Media.TITLE, "NewPic"); //Titre de l'image
        values.put(MediaStore.Images.Media.DESCRIPTION, "Image To text"); //Description de l'image
        image_uri = getContentResolver().insert(MediaStore.Images.Media.EXTERNAL_CONTENT_URI, values);

        Intent cameraIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        cameraIntent.putExtra(MediaStore.EXTRA_OUTPUT, image_uri);
        startActivityForResult(cameraIntent, IMAGE_PICK_CAMERA_CODE);
    }

    // Demande d'accès au stockage interne du téléphone
    private void requestStoragePermission() {
        ActivityCompat.requestPermissions(this, storagePermission, STORAGE_REQUEST_CODE);
    }

    // Vérification de la demande d'accès au stockage interne du téléphone
    private boolean checkStoragePermission() {
        boolean result = ContextCompat.checkSelfPermission(this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE) == (PackageManager.PERMISSION_GRANTED);
        return result;
    }

    // Demande d'accès à l'appareil photo du téléphone
    private void requestCameraPermission() {
        ActivityCompat.requestPermissions(this, cameraPermission, CAMERA_REQUEST_CODE);
    }

    // Vérification de la demande d'accès à l'appareil photo du téléphone
    private boolean checkCameraPermission() {
        /*Vérifie la permission et retourne le résultat
        * Pour avoir une image de haute qualité, il faut sauver l'image dans le stockage externe de l'appareil
        * avant de l'ajouter à "l'image view", il faut donc demander également la permission d'accès au stockage
         */


        boolean result = ContextCompat.checkSelfPermission(this,
                Manifest.permission.CAMERA) == (PackageManager.PERMISSION_GRANTED);
        boolean result1 = ContextCompat.checkSelfPermission(this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE) == (PackageManager.PERMISSION_GRANTED);
        return result && result1;
    }



    // Gérer le résultat des permissions (Refusé, accepté...)
    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        switch (requestCode){
            case CAMERA_REQUEST_CODE:
                if (grantResults.length >0){
                    boolean cameraAccpeted = grantResults[0] ==
                            PackageManager.PERMISSION_GRANTED;
                    boolean writeStorageAccepted = grantResults[0] ==
                            PackageManager.PERMISSION_GRANTED;
                    if (cameraAccpeted && writeStorageAccepted){
                        pickCamera();
                    }
                    else{
                        Toast.makeText(this, "permission denied", Toast.LENGTH_SHORT).show();
                    }
                }
                break;

            case STORAGE_REQUEST_CODE:
                if (grantResults.length >0){
                    boolean writeStorageAccepted = grantResults[0] ==
                            PackageManager.PERMISSION_GRANTED;
                    if (writeStorageAccepted){
                        pickGallery();
                    }
                    else{
                        Toast.makeText(this, "permission denied", Toast.LENGTH_SHORT).show();
                    }
                }
                break;
        }
    }

    // Gérer le résulat de l'image
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (resultCode == RESULT_OK){
            if (requestCode == IMAGE_PICK_GALLERY_CODE){
                // Réception de l'image depuis la bibliothèque, la recadrer
                CropImage.activity(data.getData())
                        .setGuidelines(CropImageView.Guidelines.ON) //Activation du "guideur" d'image
                        .start(this);


            }
            if (requestCode == IMAGE_PICK_CAMERA_CODE){
                // Réception de l'image depuis la caméra, la recadrer
                CropImage.activity(image_uri)
                        .setGuidelines(CropImageView.Guidelines.ON) //Activation du "guideur" d'image
                        .start(this);
                }
        }
        // Prendre l'image recadrée
        if (requestCode == CropImage.CROP_IMAGE_ACTIVITY_REQUEST_CODE){
            CropImage.ActivityResult result = CropImage.getActivityResult(data);
            if (resultCode == RESULT_OK){
               Uri resultUri = result.getUri(); // Réception de l'uri de l'image
                // Régler l'image sur l'affichage de l'image
                mPreviewIv.setImageURI(resultUri);

                // Obtenir des images bitmap dessinables pour la reconnaissance de texte
                BitmapDrawable bitmapDrawable = (BitmapDrawable)mPreviewIv.getDrawable();
                Bitmap bitmap = bitmapDrawable.getBitmap();

                TextRecognizer recognizer = new TextRecognizer.Builder(getApplicationContext()).build();

                if (!recognizer.isOperational()){
                    Toast.makeText(this, "Error", Toast.LENGTH_SHORT).show();
                }
                else {
                    Frame frame = new Frame.Builder().setBitmap(bitmap).build();
                    SparseArray<TextBlock> items = recognizer.detect(frame);
                    StringBuilder sb = new StringBuilder();
                    // Recevoir du texte du StringBuilder jusqu'à si il n'y en a pas
                    for (int i =0; i<items.size(); i++){
                        TextBlock myItem = items.valueAt(i);
                        sb.append(myItem.getValue());
                        sb.append("\n");
                    }
                    // Définir le texte pour éditer le texte
                    mResultEt.setText(sb.toString());
                }
            }
            else if (resultCode == CropImage.CROP_IMAGE_ACTIVITY_RESULT_ERROR_CODE){
                    // S'il y a une erreur, l'afficher.
                    Exception error = result.getError();
                    Toast.makeText(this, ""+error, Toast.LENGTH_SHORT).show();
            }
        }
    }

}
