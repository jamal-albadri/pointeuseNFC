package com.cfpt.nfc;

import android.app.PendingIntent;
import android.content.ContentResolver;
import android.content.Intent;
import android.nfc.NdefMessage;
import android.nfc.NdefRecord;
import android.nfc.NfcAdapter;
import android.nfc.Tag;
import android.nfc.tech.Ndef;
import android.nfc.tech.NdefFormatable;
import android.os.Parcelable;
import android.provider.Settings;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;
import android.content.IntentFilter;

import java.util.Arrays;
import java.util.Locale;


public class MainActivity extends AppCompatActivity {
    NfcAdapter nfc ;
    TextView tv;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        nfc = NfcAdapter.getDefaultAdapter(this);
        tv = (TextView)findViewById(R.id.lblNfced);
    }

    @Override
    protected void onNewIntent(Intent intent) {

        Toast.makeText(this, "Nfc Detected", Toast.LENGTH_LONG).show();
        if(intent.hasExtra(nfc.EXTRA_TAG))
        {

        }
        byte[] lala = intent.getByteArrayExtra(NfcAdapter.EXTRA_ID);
        byte[] lalo = intent.getByteArrayExtra(nfc.EXTRA_ID);
        if(lala != null && lala.length>0)
        {
            for (int i =0;i<lala.length;i++)
            {
                System.out.println(lala[i]);
            }
            for (int i =0;i<lalo.length;i++)
            {
                System.out.println(lalo[i]);
            }
            String result = new String(lala);
            String result1 = new String(lalo);
            System.out.println(result);
        }
        super.onNewIntent(intent);
    }

    @Override
    protected void onResume() {
        super.onResume();
        enableForegroundDispatchSystem();
    }

    @Override
    protected void onPause() {
        super.onPause();
        disableForegroundDispatchSystem();
    }
    private void enableForegroundDispatchSystem(){
        Intent intent = new Intent(this,MainActivity.class);
        intent.addFlags(intent.FLAG_RECEIVER_REPLACE_PENDING);
        PendingIntent pendingIntent = PendingIntent.getActivity(this,0,intent,0);
        IntentFilter[] intentFilters = new IntentFilter[]{};

        nfc.enableForegroundDispatch(this,pendingIntent,intentFilters,null);

    }
    private void disableForegroundDispatchSystem() {
        nfc.disableForegroundDispatch(this);
    }

}

