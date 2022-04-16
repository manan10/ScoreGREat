package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

public class Profile extends AppCompatActivity {
    TextView tv1,tv2,tv3;
    private FirebaseAuth mAuth;
    private DatabaseReference md;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        tv1 = findViewById(R.id.tv1);
        tv2 = findViewById(R.id.tv2);
        tv3 = findViewById(R.id.tv3);

        mAuth = FirebaseAuth.getInstance();
        md = FirebaseDatabase.getInstance().getReference();

        this.getSupportActionBar().hide();
        FirebaseUser currentUser = mAuth.getCurrentUser();
        String ab = currentUser.getUid();

        md.child("users").child(ab).child("un").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {
            }

            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                tv1.setText(dataSnapshot.getValue().toString());
            }
        });

        md.child("users").child(ab).child("email").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {
            }

            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                tv2.setText(dataSnapshot.getValue().toString());
            }
        });

        md.child("users").child(ab).child("phno").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {
            }

            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                tv3.setText(dataSnapshot.getValue().toString());
            }
        });
    }
}

