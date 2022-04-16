package com.example.scoregreat;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Toast;

public class ViewAwa extends AppCompatActivity {
    String q_id;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_awa);

        Intent intent = getIntent();
        q_id = intent.getStringExtra("ques_no");
        Toast.makeText(this, q_id, Toast.LENGTH_SHORT).show();
    }
}
