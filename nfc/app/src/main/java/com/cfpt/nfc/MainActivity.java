package com.cfpt.nfc;

import android.app.PendingIntent;
import android.content.ContentResolver;
import android.content.Intent;
import android.nfc.NfcAdapter;
import android.provider.Settings;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;
import android.content.IntentFilter;


import android.provider.Settings.System;
import android.view.WindowManager.LayoutParams;
import android.view.Window;


public class MainActivity extends AppCompatActivity {
    NfcAdapter nfc ;
    TextView tv;
    ContentResolver cr ;
    int brightness;
    public Window window;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        nfc = NfcAdapter.getDefaultAdapter(this);
        tv = (TextView)findViewById(R.id.lblNfced);
        cr = getContentResolver();
        window = getWindow();
        try
        {
            brightness = System.getInt(cr,System.SCREEN_BRIGHTNESS);
        }
        catch(Settings.SettingNotFoundException e)
        {
            e.getMessage();
        }
    }

    @Override
    protected void onNewIntent(Intent intent) {
        System.putInt( cr,System.SCREEN_BRIGHTNESS,0);
        LayoutParams layoutpars = window.getAttributes();
        //Set the brightness of this window
        layoutpars.screenBrightness = 0 ;
        //Apply attribute changes to this window
        window.setAttributes(layoutpars);
        Toast.makeText(this, "Nfc Detected", Toast.LENGTH_LONG).show();
        super.onNewIntent(intent);
    }

    @Override
    protected void onResume() {
        Intent intent = new Intent(this,MainActivity.class);
        intent.addFlags(intent.FLAG_RECEIVER_REPLACE_PENDING);
        PendingIntent pendingIntent = PendingIntent.getActivity(this,0,intent,0);
        IntentFilter[] intentFilters = new IntentFilter[]{};

        nfc.enableForegroundDispatch(this,pendingIntent,intentFilters,null);
        super.onResume();
    }

    @Override
    protected void onPause() {
        nfc.disableForegroundDispatch(this);
        super.onPause();
    }
}
