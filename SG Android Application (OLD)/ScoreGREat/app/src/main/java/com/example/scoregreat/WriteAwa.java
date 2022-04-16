package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.ViewModelProviders;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.material.textfield.TextInputEditText;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.Random;
import java.util.UUID;

class enterAWA{
    public String que;
    public String ans;
    public String userID;
    public String usname;

    public enterAWA(String que,String ans,String userID,String usname){
        this.que = que;
        this.ans = ans;
        this.userID = userID;
        this.usname = usname;
    }
}


public class WriteAwa extends AppCompatActivity {
    String ques;
    ActionBar toolbar;
    TextInputEditText write;
    TextView tv;
    DatabaseReference md;
    String uid,usname;
    Button sub;
    int i=1;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_write_awa);

        Intent intent = getIntent();
        ques = intent.getStringExtra("ques");

        toolbar = this.getSupportActionBar();
        toolbar.setTitle("Write your AWA");

        tv = findViewById(R.id.tv1);
        write = findViewById(R.id.write);
        sub = findViewById(R.id.submit);


        FirebaseAuth fAuth = FirebaseAuth.getInstance();
        FirebaseUser user;
        user = fAuth.getCurrentUser();
        uid = user.getUid();
        md = FirebaseDatabase.getInstance().getReference();

        md.child("users").child(uid).child("un").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                usname = dataSnapshot.getValue().toString();
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        sub.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                enterAWA object = new enterAWA(ques,write.getText().toString(),uid,usname);
                md.child("essays").child(UUID.randomUUID().toString()).setValue(object);
                Intent intent1 = new Intent(WriteAwa.this,AwaHome.class);
                startActivity(intent1);
            }
        });

        tv.setText(ques);
    }
}
