package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.database.ChildEventListener;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import static com.firebase.ui.auth.AuthUI.getApplicationContext;

//class QuestionFetch
//{
//    public String qid;
//    DatabaseReference md;
//
//    QuestionFetch(){
//        md = FirebaseDatabase.getInstance().getReference().child("essays");
//    }
//
//    public String get_quesid(int i){
//        final int k = i;
//        final String[] a = new String[1];
//        md.addValueEventListener(new ValueEventListener() {
//            @Override
//            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
//                int j=0;
//                for (DataSnapshot ds : dataSnapshot.getChildren()) {
//                    if(j==k) {
//                        a[0] =  ds.getValue().toString();
//                    }
//                }
//            }
//            @Override
//            public void onCancelled(@NonNull DatabaseError databaseError) {
//
//            }
//        });
//        return a[0];
//    }
//}
public class FeedFragment extends Fragment {
    ListView listView;
    String mTitle[] = new String[10];
    String mDecryption[] = new String[10];
    String mAns[] = new String[10];
    Context c;
    DatabaseReference md;
    int i=0;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View rv = inflater.inflate(R.layout.activity_feed_fragment, container, false);
        md = FirebaseDatabase.getInstance().getReference().child("essays");
        listView =rv.findViewById(R.id.listview);


        md.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                int j=0;
                for(DataSnapshot ds : dataSnapshot.getChildren()) {
                    mTitle[j] = ds.child("usname").getValue().toString();
                    mDecryption[j] = ds.child("que").getValue().toString();
                    mAns[j] = ds.child("ans").getValue().toString();
                    j++;
                }
                getdata(listView);
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
//                QuestionFetch qf = new QuestionFetch();
//                String abc = qf.get_quesid(i);
                Toast.makeText(getActivity(), "Here", Toast.LENGTH_SHORT).show();
//                Intent intent = new Intent(getActivity(),ViewAwa.class);
//                intent.putExtra("ques_id",abc);
            }
        });
        return rv;
    }

    public void getdata(final ListView listView){
        c = getContext();
        MyAdapter adapter = new MyAdapter(c,mTitle,mDecryption,mAns);
        listView.setAdapter(adapter);
    }

    class MyAdapter extends ArrayAdapter<String> {
        Context c;
        String rt[];
        String rd[];
        String ri[];

        MyAdapter(Context c, String title[], String des[], String mAns[]) {
            super(c, R.layout.row,R.id.tv1,title);
            this.c = c;
            this.rt = title;
            this.rd = des;
            this.ri = mAns;
        }

        @NonNull
        @Override
        public View getView(int pos, @Nullable View cv, @NonNull ViewGroup p) {
            LayoutInflater layoutInflater = (LayoutInflater) getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            View row = layoutInflater.inflate(R.layout.row, p, false);

            TextView mtitle = row.findViewById(R.id.tv1);
            TextView mdes = row.findViewById(R.id.tv2);
            TextView mans = row.findViewById(R.id.tv3);

            mans.setText(ri[pos]);
            mtitle.setText(rt[pos]);
            mdes.setText(rd[pos]);
            return row;
        }
    }
}
