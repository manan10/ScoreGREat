package com.example.scoregreat;

import android.os.Bundle;
import android.view.MenuItem;

import com.google.android.material.appbar.AppBarLayout;
import com.google.android.material.bottomnavigation.BottomNavigationView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBar;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentTransaction;
import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

public class AwaHome extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_awa_home);
        BottomNavigationView navView = findViewById(R.id.nav_view);
        ActionBar toolbar = getSupportActionBar();
        toolbar.setTitle("AWA Home");

        Fragment fg = new EmptyFragment();
        FragmentTransaction fmg = getSupportFragmentManager().beginTransaction();
        fmg.replace(R.id.nav_host_fragment,fg).commit();
        navView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                Fragment f= null;
                FragmentTransaction fm = getSupportFragmentManager().beginTransaction();
                int id = item.getItemId();
                if(id == R.id.feed) {
                    if(f != null)
                        getSupportFragmentManager().popBackStackImmediate();
                    f = new FeedFragment();
                }
                else if(id == R.id.create) {
                    if(f != null)
                        getSupportFragmentManager().popBackStackImmediate();
                    f = new AddAwaFragment();
                }
                else if(id == R.id.writeups) {
                    if(f != null)
                        getSupportFragmentManager().popBackStackImmediate();
                    f = new MyWriteUps();
                }
                fm.replace(R.id.nav_host_fragment, f).commit();
                return true;
            }
        });
    }

}
