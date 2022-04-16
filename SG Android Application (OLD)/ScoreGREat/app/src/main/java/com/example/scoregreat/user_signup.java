package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.android.material.textfield.TextInputEditText;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;


class User {
    public String un;
    public String email;
    public String phno;
    public boolean diag;
    public String title_content;

    User(){}

    User(String user,String phno,String email,boolean diag,String title_content)
    {
        un = user;
        this.phno = phno;
        this.email = email;
        this.diag = diag;
        this.title_content = title_content;
    }
}



public class user_signup extends AppCompatActivity implements View.OnClickListener {
    TextInputEditText email,pwd,username,phno;
    private FirebaseAuth mAuth;
    private DatabaseReference md;
    private static final String TAG = "EmailPassword";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_signup);
        this.getSupportActionBar().hide();
        email = findViewById(R.id.email);
        pwd = findViewById(R.id.pwd);
        username = findViewById(R.id.username);
        phno = findViewById(R.id.phno);
        md = FirebaseDatabase.getInstance().getReference();
        findViewById(R.id.submit).setOnClickListener(this);
        mAuth = FirebaseAuth.getInstance();
    }

    public void onStart(View view){
        super.onStart();
        FirebaseUser currentUser = mAuth.getCurrentUser();
    }



    private void writeUser(String uid,String name,String phno,String email,boolean a,String tc)
    {
        User user = new User(name,phno,email,a,tc);
        md.child("users").child(uid).setValue(user);
    }

    private void sendEmailVerification() {

        final FirebaseUser user = mAuth.getCurrentUser();
        user.sendEmailVerification()
                .addOnCompleteListener(this, new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        // [START_EXCLUDE]
                        // Re-enable button

                        if (task.isSuccessful()) {
                            Toast.makeText(user_signup.this,
                                    "Verification email sent to " + user.getEmail(),
                                    Toast.LENGTH_SHORT).show();
                        } else {
                            Log.e(TAG, "sendEmailVerification", task.getException());
                            Toast.makeText(user_signup.this,
                                    "Failed to send verification email.",
                                    Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }

    private void onAuthSuccess(FirebaseUser user){
        //String un = usernameFromEmail(user.getEmail());
        String ph = phno.getText().toString();
        String un = username.getText().toString();
        writeUser(user.getUid(),un,ph,user.getEmail(),false,"");
    }


    private void createAccount(final String email, String password) {
        Log.d(TAG, "createAccount:" + email);
        if (!validateForm()) {
            return;
        }

        final FirebaseUser user = mAuth.getCurrentUser();
        mAuth.createUserWithEmailAndPassword(email, password)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()) {
                            // Sign in success
                            Log.d(TAG, "createUserWithEmail:success");
                            sendEmailVerification();
                            onAuthSuccess(task.getResult().getUser());
                        } else {
                            // If sign in fails, display a message to the user.
                            Log.w(TAG, "createUserWithEmail:failure", task.getException());
                            Toast.makeText(user_signup.this, "Authentication failed.",
                                    Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }

    private boolean validateForm() {
        boolean valid = true;

        String em = email.getText().toString();
        if (TextUtils.isEmpty(em)) {
            email.setError("Required.");
            valid = false;
        } else {
            email.setError(null);
        }

        String password = pwd.getText().toString();
        if (TextUtils.isEmpty(password)) {
            pwd.setError("Required.");
            valid = false;
        } else {
            pwd.setError(null);
        }

        String un = username.getText().toString();
        if (TextUtils.isEmpty(password)) {
            username.setError("Required.");
            valid = false;
        } else {
            username.setError(null);
        }
        return valid;
    }

    @Override
    public void onClick(View view) {
        int id = view.getId();

        if(id == R.id.submit){
            createAccount(email.getText().toString(),pwd.getText().toString());
           new Handler().postDelayed(new Runnable() {
                            @Override
            public void run() {

                Intent i=new Intent(user_signup.this,MainActivity.class);
                startActivity(i);
            }
        }, 3000);

        }
    }
}
