package com.example.scoregreat;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import android.view.View;

import androidx.annotation.NonNull;
import androidx.core.view.GravityCompat;
import androidx.appcompat.app.ActionBarDrawerToggle;

import android.view.MenuItem;

import com.google.android.material.navigation.NavigationView;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import androidx.drawerlayout.widget.DrawerLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.view.Menu;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

public class UserHome extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    Button b;
    SharedPreferences sp;
    TextView tv1,tv2,que;
    private FirebaseAuth mAuth;
    private DatabaseReference md;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_home);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        NavigationView navigationView = findViewById(R.id.nav_view);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        navigationView.setNavigationItemSelectedListener(this);

        mAuth = FirebaseAuth.getInstance();
        md = FirebaseDatabase.getInstance().getReference();

        View headerView = navigationView.getHeaderView(0);
        FirebaseUser currentUser = mAuth.getCurrentUser();
        String ab = currentUser.getUid();

        Fragment fragment = new HomeFragment();
        FragmentManager fm = getSupportFragmentManager();
        fm.beginTransaction().replace(R.id.container,fragment).addToBackStack(null).commit();

        tv1 = headerView.findViewById(R.id.tv1);
        tv2 = headerView.findViewById(R.id.tv2);


        headerView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i =  new Intent(UserHome.this,Profile.class);
                startActivity(i);
            }
        });


        md.child("users").child(ab).child("un").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                tv1.setText(dataSnapshot.getValue().toString());
               // que.setText("Welcome "+ dataSnapshot.getValue().toString()+ " !");
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        md.child("users").child(ab).child("email").addListenerForSingleValueEvent(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                tv2.setText(dataSnapshot.getValue().toString());
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

    }

    public void onStart(View view){
        super.onStart();

    }

    @Override
    public void onBackPressed() {
        // Do Here what ever you want do on back press;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.user_home, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
           Intent i = new Intent(UserHome.this,Profile.class);
           startActivity(i);
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        Fragment fragment = null;
        FragmentManager fragMan = getSupportFragmentManager();
        if (id == R.id.nav_logout) {
            sp = getSharedPreferences("login",MODE_PRIVATE);
            sp.edit().putBoolean("logged",false).apply();
            Intent i = new Intent(UserHome.this,MainActivity.class);
            startActivity(i);
        } else if (id == R.id.nav_practice) {
            fragment = new PracticeFragment();
            fragMan.beginTransaction().replace(R.id.container,fragment).addToBackStack(null).commit();
        } else if (id == R.id.nav_public) {

        }else if (id == R.id.nav_home) {
            fragment = new HomeFragment();
        } else if (id == R.id.nav_exp) {

        } else if (id == R.id.nav_awa) {
            Intent intent = new Intent(UserHome.this,AwaHome.class);
            startActivity(intent);
        } else if (id == R.id.nav_mock) {

        }else if (id == R.id.nav_multi) {

        }else if (id == R.id.save_notes) {
            fragment = new NotesDisplayFragment();
        }


        if(fragment != null){
            FragmentManager fm = getSupportFragmentManager();
            fm.beginTransaction().replace(R.id.container,fragment).addToBackStack(null).commit();
        }

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
